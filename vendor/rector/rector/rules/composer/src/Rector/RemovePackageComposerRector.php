<?php

declare (strict_types=1);
namespace Rector\Composer\Rector;

use Rector\Composer\Contract\Rector\CoreComposerRectorInterface;
use Typo3RectorPrefix20210311\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Rector\Composer\Tests\Rector\RemovePackageComposerRector\RemovePackageComposerRectorTest
 */
final class RemovePackageComposerRector implements \Rector\Composer\Contract\Rector\CoreComposerRectorInterface
{
    /**
     * @var string
     */
    public const PACKAGE_NAMES = 'package_names';
    /**
     * @var string[]
     */
    private $packageNames = [];
    public function refactor(\Typo3RectorPrefix20210311\Symplify\ComposerJsonManipulator\ValueObject\ComposerJson $composerJson) : void
    {
        foreach ($this->packageNames as $packageName) {
            $composerJson->removePackage($packageName);
        }
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Remove package from "require" and "require-dev" in `composer.json`', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample(<<<'CODE_SAMPLE'
{
    "require": {
        "symfony/console": "^3.4"
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
{
}
CODE_SAMPLE
, [self::PACKAGE_NAMES => ['symfony/console']])]);
    }
    /**
     * @param array<string, string[]> $configuration
     */
    public function configure(array $configuration) : void
    {
        $this->packageNames = $configuration[self::PACKAGE_NAMES] ?? [];
    }
}
