<?php

declare (strict_types=1);
namespace Rector\PSR4\Composer;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use PhpParser\Node;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\NodeTypeResolver\FileSystem\CurrentFileInfoProvider;
use Rector\PSR4\Contract\PSR4AutoloadNamespaceMatcherInterface;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class PSR4NamespaceMatcher implements \Rector\PSR4\Contract\PSR4AutoloadNamespaceMatcherInterface
{
    /**
     * @var PSR4AutoloadPathsProvider
     */
    private $psr4AutoloadPathsProvider;
    /**
     * @var CurrentFileInfoProvider
     */
    private $currentFileInfoProvider;
    public function __construct(\Rector\PSR4\Composer\PSR4AutoloadPathsProvider $psr4AutoloadPathsProvider, \Rector\NodeTypeResolver\FileSystem\CurrentFileInfoProvider $currentFileInfoProvider)
    {
        $this->psr4AutoloadPathsProvider = $psr4AutoloadPathsProvider;
        $this->currentFileInfoProvider = $currentFileInfoProvider;
    }
    public function getExpectedNamespace(\PhpParser\Node $node) : ?string
    {
        $smartFileInfo = $this->currentFileInfoProvider->getSmartFileInfo();
        if (!$smartFileInfo instanceof \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo) {
            throw new \Rector\Core\Exception\ShouldNotHappenException();
        }
        $psr4Autoloads = $this->psr4AutoloadPathsProvider->provide();
        foreach ($psr4Autoloads as $namespace => $path) {
            // remove extra slash
            /** @var string[] $paths */
            $paths = \is_array($path) ? $path : [$path];
            foreach ($paths as $singlePath) {
                $singlePath = \rtrim($singlePath, '/');
                if (!\Typo3RectorPrefix20210311\Nette\Utils\Strings::startsWith($smartFileInfo->getRelativeDirectoryPath(), $singlePath)) {
                    continue;
                }
                $expectedNamespace = $namespace . $this->resolveExtraNamespace($smartFileInfo, $singlePath);
                return \rtrim($expectedNamespace, '\\');
            }
        }
        return null;
    }
    /**
     * Get the extra path that is not included in root PSR-4 namespace
     */
    private function resolveExtraNamespace(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, string $path) : string
    {
        $extraNamespace = \Typo3RectorPrefix20210311\Nette\Utils\Strings::substring($smartFileInfo->getRelativeDirectoryPath(), \Typo3RectorPrefix20210311\Nette\Utils\Strings::length($path) + 1);
        $extraNamespace = \Typo3RectorPrefix20210311\Nette\Utils\Strings::replace($extraNamespace, '#/#', '\\');
        return \trim($extraNamespace);
    }
}
