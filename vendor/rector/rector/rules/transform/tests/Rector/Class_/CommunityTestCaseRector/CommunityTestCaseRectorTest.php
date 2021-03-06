<?php

declare (strict_types=1);
namespace Rector\Transform\Tests\Rector\Class_\CommunityTestCaseRector;

use Iterator;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Rector\Transform\Rector\Class_\CommunityTestCaseRector;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem;
final class CommunityTestCaseRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $fileInfo, \Rector\FileSystemRector\ValueObject\AddedFileWithContent $addedFileWithContent) : void
    {
        $this->doTestFileInfo($fileInfo);
        $this->assertFileWithContentWasAdded($addedFileWithContent);
    }
    public function provideData() : \Iterator
    {
        $smartFileSystem = new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem();
        (yield [new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo(__DIR__ . '/Fixture/some_class.php.inc'), new \Rector\FileSystemRector\ValueObject\AddedFileWithContent($this->getFixtureTempDirectory() . '/config/configured_rule.php', $smartFileSystem->readFile(__DIR__ . '/Expected/config/configured_rule.php'))]);
    }
    protected function getRectorClass() : string
    {
        return \Rector\Transform\Rector\Class_\CommunityTestCaseRector::class;
    }
}
