<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223\Symplify\EasyTesting;

use Typo3RectorPrefix20210223\Nette\Utils\Strings;
use Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputAndExpected;
use Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpected;
use Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpectedFileInfo;
use Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\SplitLine;
use Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo;
use Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileSystem;
final class StaticFixtureSplitter
{
    /**
     * @var string|null
     */
    public static $customTemporaryPath;
    public static function splitFileInfoToInputAndExpected(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputAndExpected
    {
        $splitLineCount = \count(\Typo3RectorPrefix20210223\Nette\Utils\Strings::matchAll($smartFileInfo->getContents(), \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\SplitLine::SPLIT_LINE_REGEX));
        // if more or less, it could be a test cases for monorepo line in it
        if ($splitLineCount === 1) {
            // input → expected
            [$input, $expected] = \Typo3RectorPrefix20210223\Nette\Utils\Strings::split($smartFileInfo->getContents(), \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\SplitLine::SPLIT_LINE_REGEX);
            $expected = self::retypeExpected($expected);
            return new \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputAndExpected($input, $expected);
        }
        // no changes
        return new \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputAndExpected($smartFileInfo->getContents(), $smartFileInfo->getContents());
    }
    public static function splitFileInfoToLocalInputAndExpectedFileInfos(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, bool $autoloadTestFixture = \false) : \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpectedFileInfo
    {
        $inputAndExpected = self::splitFileInfoToInputAndExpected($smartFileInfo);
        $inputFileInfo = self::createTemporaryFileInfo($smartFileInfo, 'input', $inputAndExpected->getInput());
        // some files needs to be autoload to enable reflection
        if ($autoloadTestFixture) {
            require_once $inputFileInfo->getRealPath();
        }
        $expectedFileInfo = self::createTemporaryFileInfo($smartFileInfo, 'expected', $inputAndExpected->getExpected());
        return new \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpectedFileInfo($inputFileInfo, $expectedFileInfo);
    }
    public static function getTemporaryPath() : string
    {
        if (self::$customTemporaryPath !== null) {
            return self::$customTemporaryPath;
        }
        return \sys_get_temp_dir() . '/_temp_fixture_easy_testing';
    }
    public static function createTemporaryFileInfo(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $fixtureSmartFileInfo, string $prefix, string $fileContent) : \Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo
    {
        $temporaryFilePath = self::createTemporaryPathWithPrefix($fixtureSmartFileInfo, $prefix);
        $smartFileSystem = new \Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileSystem();
        $smartFileSystem->dumpFile($temporaryFilePath, $fileContent);
        return new \Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo($temporaryFilePath);
    }
    public static function splitFileInfoToLocalInputAndExpected(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, bool $autoloadTestFixture = \false) : \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpected
    {
        $inputAndExpected = self::splitFileInfoToInputAndExpected($smartFileInfo);
        $inputFileInfo = self::createTemporaryFileInfo($smartFileInfo, 'input', $inputAndExpected->getInput());
        // some files needs to be autoload to enable reflection
        if ($autoloadTestFixture) {
            require_once $inputFileInfo->getRealPath();
        }
        return new \Typo3RectorPrefix20210223\Symplify\EasyTesting\ValueObject\InputFileInfoAndExpected($inputFileInfo, $inputAndExpected->getExpected());
    }
    private static function createTemporaryPathWithPrefix(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, string $prefix) : string
    {
        $hash = \Typo3RectorPrefix20210223\Nette\Utils\Strings::substring(\md5($smartFileInfo->getRealPath()), -20);
        $fileBaseName = $smartFileInfo->getBasename('.inc');
        return self::getTemporaryPath() . \sprintf('/%s_%s_%s', $prefix, $hash, $fileBaseName);
    }
    /**
     * @return mixed|int|float
     */
    private static function retypeExpected($expected)
    {
        if (!\is_numeric(\trim($expected))) {
            return $expected;
        }
        // value re-type
        if (\strlen((string) (int) $expected) === \strlen(\trim($expected))) {
            return (int) $expected;
        }
        if (\strlen((string) (float) $expected) === \strlen(\trim($expected))) {
            return (float) $expected;
        }
        return $expected;
    }
}