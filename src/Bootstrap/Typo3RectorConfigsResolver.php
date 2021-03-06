<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\Bootstrap;

use Rector\Core\ValueObject\Bootstrap\BootstrapConfigs;
use Rector\Set\RectorSetProvider;
use Ssch\TYPO3Rector\Set\Typo3RectorSetProvider;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Input\ArgvInput;
use Typo3RectorPrefix20210311\Symplify\SetConfigResolver\ConfigResolver;
use Typo3RectorPrefix20210311\Symplify\SetConfigResolver\SetAwareConfigResolver;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class Typo3RectorConfigsResolver
{
    /**
     * @var ConfigResolver
     */
    private $configResolver;
    /**
     * @var SetAwareConfigResolver
     */
    private $setAwareConfigResolver;
    /**
     * @var array<string, SmartFileInfo[]>
     */
    private $resolvedConfigFileInfos = [];
    public function __construct()
    {
        $this->configResolver = new \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\ConfigResolver();
        $rectorSetProvider = new \Ssch\TYPO3Rector\Set\Typo3RectorSetProvider(new \Rector\Set\RectorSetProvider());
        $this->setAwareConfigResolver = new \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\SetAwareConfigResolver($rectorSetProvider);
    }
    /**
     * @return SmartFileInfo[]
     */
    public function resolveFromConfigFileInfo(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $configFileInfo) : array
    {
        $hash = \sha1($configFileInfo->getRealPath());
        if (isset($this->resolvedConfigFileInfos[$hash])) {
            return $this->resolvedConfigFileInfos[$hash];
        }
        $setFileInfos = $this->setAwareConfigResolver->resolveFromParameterSetsFromConfigFiles([$configFileInfo]);
        $configFileInfos = \array_merge([$configFileInfo], $setFileInfos);
        $this->resolvedConfigFileInfos[$hash] = $configFileInfos;
        return $configFileInfos;
    }
    public function provide() : \Rector\Core\ValueObject\Bootstrap\BootstrapConfigs
    {
        $configFileInfos = [];
        $argvInput = new \Typo3RectorPrefix20210311\Symfony\Component\Console\Input\ArgvInput();
        $mainConfigFileInfo = $this->configResolver->resolveFromInputWithFallback($argvInput, ['rector.php']);
        if (null !== $mainConfigFileInfo) {
            $setFileInfos = $this->setAwareConfigResolver->resolveFromParameterSetsFromConfigFiles([$mainConfigFileInfo]);
            $configFileInfos = \array_merge($configFileInfos, $setFileInfos);
        }
        if (\in_array($argvInput->getFirstArgument(), ['generate', 'g', 'create', 'c'], \true)) {
            // autoload rector recipe file if present, just for \Rector\RectorGenerator\Command\GenerateCommand
            $rectorRecipeFilePath = \getcwd() . '/rector-recipe.php';
            if (\file_exists($rectorRecipeFilePath)) {
                $configFileInfos[] = new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo($rectorRecipeFilePath);
            }
        }
        return new \Rector\Core\ValueObject\Bootstrap\BootstrapConfigs($mainConfigFileInfo, $configFileInfos);
    }
}
