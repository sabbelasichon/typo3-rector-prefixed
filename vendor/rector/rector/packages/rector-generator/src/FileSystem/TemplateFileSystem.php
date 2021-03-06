<?php

declare (strict_types=1);
namespace Rector\RectorGenerator\FileSystem;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use Rector\RectorGenerator\Finder\TemplateFinder;
use Rector\RectorGenerator\TemplateFactory;
use Rector\RectorGenerator\ValueObject\RectorRecipe;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class TemplateFileSystem
{
    /**
     * @var string
     * @see https://regex101.com/r/fw3jBe/1
     */
    private const FIXTURE_SHORT_REGEX = '#/Fixture/#';
    /**
     * @var string
     * @see https://regex101.com/r/HBcfXd/1
     */
    private const PACKAGE_RULES_PATH_REGEX = '#(packages|rules)\\/__package__#i';
    /**
     * @var string
     * @see https://regex101.com/r/tOidWU/1
     */
    private const CONFIGURED_OR_EXTRA_REGEX = '#(__Configured|__Extra)#';
    /**
     * @var TemplateFactory
     */
    private $templateFactory;
    public function __construct(\Rector\RectorGenerator\TemplateFactory $templateFactory)
    {
        $this->templateFactory = $templateFactory;
    }
    /**
     * @param array<string, mixed> $templateVariables
     */
    public function resolveDestination(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, array $templateVariables, \Rector\RectorGenerator\ValueObject\RectorRecipe $rectorRecipe, string $targetDirectory) : string
    {
        $destination = $smartFileInfo->getRelativeFilePathFromDirectory(\Rector\RectorGenerator\Finder\TemplateFinder::TEMPLATES_DIRECTORY);
        // normalize core package
        if (!$rectorRecipe->isRectorRepository()) {
            // special keyword for 3rd party Rectors, not for core Github contribution
            $destination = \Typo3RectorPrefix20210311\Nette\Utils\Strings::replace($destination, self::PACKAGE_RULES_PATH_REGEX, 'utils/rector');
        }
        // remove _Configured|_Extra prefix
        $destination = $this->templateFactory->create($destination, $templateVariables);
        $destination = \Typo3RectorPrefix20210311\Nette\Utils\Strings::replace($destination, self::CONFIGURED_OR_EXTRA_REGEX, '');
        // remove ".inc" protection from PHPUnit if not a test case
        if ($this->isNonFixtureFileWithIncSuffix($destination)) {
            $destination = \Typo3RectorPrefix20210311\Nette\Utils\Strings::before($destination, '.inc');
        }
        // special hack for tests, to PHPUnit doesn't load the generated file as test case
        /** @var string $destination */
        if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::endsWith($destination, 'Test.php') && \Rector\Testing\PHPUnit\StaticPHPUnitEnvironment::isPHPUnitRun()) {
            $destination .= '.inc';
        }
        return $targetDirectory . \DIRECTORY_SEPARATOR . $destination;
    }
    private function isNonFixtureFileWithIncSuffix(string $filePath) : bool
    {
        if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::match($filePath, self::FIXTURE_SHORT_REGEX)) {
            return \false;
        }
        return \Typo3RectorPrefix20210311\Nette\Utils\Strings::endsWith($filePath, '.inc');
    }
}
