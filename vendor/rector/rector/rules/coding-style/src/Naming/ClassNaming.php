<?php

declare (strict_types=1);
namespace Rector\CodingStyle\Naming;

use Typo3RectorPrefix20210223\Nette\Utils\Strings;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\Function_;
use Rector\Core\Util\StaticRectorStrings;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo;
final class ClassNaming
{
    /**
     * @see https://regex101.com/r/8BdrI3/1
     * @var string
     */
    private const INPUT_HASH_NAMING_REGEX = '#input_(.*?)_#';
    /**
     * @param string|Name|Identifier $name
     */
    public function getVariableName($name) : string
    {
        $shortName = $this->getShortName($name);
        return \lcfirst($shortName);
    }
    /**
     * @param string|Name|Identifier|ClassLike $name
     */
    public function getShortName($name) : string
    {
        if ($name instanceof \PhpParser\Node\Stmt\ClassLike) {
            if ($name->name === null) {
                return '';
            }
            return $this->getShortName($name->name);
        }
        if ($name instanceof \PhpParser\Node\Name || $name instanceof \PhpParser\Node\Identifier) {
            $name = $name->toString();
        }
        $name = \trim($name, '\\');
        return \Typo3RectorPrefix20210223\Nette\Utils\Strings::after($name, '\\', -1) ?: $name;
    }
    public function getNamespace(string $fullyQualifiedName) : ?string
    {
        $fullyQualifiedName = \trim($fullyQualifiedName, '\\');
        return \Typo3RectorPrefix20210223\Nette\Utils\Strings::before($fullyQualifiedName, '\\', -1) ?: null;
    }
    public function getNameFromFileInfo(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : string
    {
        $basenameWithoutSuffix = $smartFileInfo->getBasenameWithoutSuffix();
        // remove PHPUnit fixture file prefix
        if (\Rector\Testing\PHPUnit\StaticPHPUnitEnvironment::isPHPUnitRun()) {
            $basenameWithoutSuffix = \Typo3RectorPrefix20210223\Nette\Utils\Strings::replace($basenameWithoutSuffix, self::INPUT_HASH_NAMING_REGEX, '');
        }
        return \Rector\Core\Util\StaticRectorStrings::underscoreToPascalCase($basenameWithoutSuffix);
    }
    /**
     * "some_function" → "someFunction"
     */
    public function createMethodNameFromFunction(\PhpParser\Node\Stmt\Function_ $function) : string
    {
        $functionName = (string) $function->name;
        return \Rector\Core\Util\StaticRectorStrings::underscoreToCamelCase($functionName);
    }
    public function replaceSuffix(string $content, string $oldSuffix, string $newSuffix) : string
    {
        if (!\Typo3RectorPrefix20210223\Nette\Utils\Strings::endsWith($content, $oldSuffix)) {
            return $content . $newSuffix;
        }
        $contentWithoutOldSuffix = \Typo3RectorPrefix20210223\Nette\Utils\Strings::substring($content, 0, -\Typo3RectorPrefix20210223\Nette\Utils\Strings::length($oldSuffix));
        return $contentWithoutOldSuffix . $newSuffix;
    }
}