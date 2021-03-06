<?php

declare (strict_types=1);
namespace Rector\RectorGenerator\Generator;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use Rector\RectorGenerator\FileSystem\TemplateFileSystem;
use Rector\RectorGenerator\TemplateFactory;
use Rector\RectorGenerator\ValueObject\RectorRecipe;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem;
final class FileGenerator
{
    /**
     * @var string
     * @see https://regex101.com/r/RVbPEX/1
     */
    public const RECTOR_UTILS_REGEX = '#Rector\\\\Utils#';
    /**
     * @var TemplateFileSystem
     */
    private $templateFileSystem;
    /**
     * @var TemplateFactory
     */
    private $templateFactory;
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem $smartFileSystem, \Rector\RectorGenerator\TemplateFactory $templateFactory, \Rector\RectorGenerator\FileSystem\TemplateFileSystem $templateFileSystem)
    {
        $this->templateFileSystem = $templateFileSystem;
        $this->templateFactory = $templateFactory;
        $this->smartFileSystem = $smartFileSystem;
    }
    /**
     * @param SmartFileInfo[] $templateFileInfos
     * @param string[] $templateVariables
     * @return string[]
     */
    public function generateFiles(array $templateFileInfos, array $templateVariables, \Rector\RectorGenerator\ValueObject\RectorRecipe $rectorRecipe, string $destinationDirectory) : array
    {
        $generatedFilePaths = [];
        foreach ($templateFileInfos as $fileInfo) {
            $generatedFilePaths[] = $this->generateFileInfoWithTemplateVariables($fileInfo, $templateVariables, $rectorRecipe, $destinationDirectory);
        }
        return $generatedFilePaths;
    }
    /**
     * @param array<string, mixed> $templateVariables
     */
    private function generateFileInfoWithTemplateVariables(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, array $templateVariables, \Rector\RectorGenerator\ValueObject\RectorRecipe $rectorRecipe, string $targetDirectory) : string
    {
        $targetFilePath = $this->templateFileSystem->resolveDestination($smartFileInfo, $templateVariables, $rectorRecipe, $targetDirectory);
        $content = $this->templateFactory->create($smartFileInfo->getContents(), $templateVariables);
        // replace "Rector\Utils\" with "Utils\Rector\" for 3rd party packages
        if (!$rectorRecipe->isRectorRepository()) {
            $content = \Typo3RectorPrefix20210311\Nette\Utils\Strings::replace($content, self::RECTOR_UTILS_REGEX, 'Typo3RectorPrefix20210311\\Utils\\Rector');
        }
        $this->smartFileSystem->dumpFile($targetFilePath, $content);
        return $targetFilePath;
    }
}
