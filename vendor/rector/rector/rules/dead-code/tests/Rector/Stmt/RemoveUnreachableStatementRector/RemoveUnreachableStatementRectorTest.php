<?php

declare (strict_types=1);
namespace Rector\DeadCode\Tests\Rector\Stmt\RemoveUnreachableStatementRector;

use Iterator;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class RemoveUnreachableStatementRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $fileInfo) : void
    {
        $this->doTestFileInfo($fileInfo);
    }
    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }
    protected function getRectorClass() : string
    {
        return \Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector::class;
    }
}
