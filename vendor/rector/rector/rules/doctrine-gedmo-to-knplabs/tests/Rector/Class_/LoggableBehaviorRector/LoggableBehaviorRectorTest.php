<?php

declare (strict_types=1);
namespace Rector\DoctrineGedmoToKnplabs\Tests\Rector\Class_\LoggableBehaviorRector;

use Iterator;
use Rector\DoctrineGedmoToKnplabs\Rector\Class_\LoggableBehaviorRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo;
final class LoggableBehaviorRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210223\Symplify\SmartFileSystem\SmartFileInfo $fileInfo) : void
    {
        $this->doTestFileInfo($fileInfo);
    }
    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }
    protected function getRectorClass() : string
    {
        return \Rector\DoctrineGedmoToKnplabs\Rector\Class_\LoggableBehaviorRector::class;
    }
}
