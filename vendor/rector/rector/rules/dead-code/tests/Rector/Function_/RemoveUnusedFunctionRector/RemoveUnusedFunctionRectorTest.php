<?php

declare (strict_types=1);
namespace Rector\DeadCode\Tests\Rector\Function_\RemoveUnusedFunctionRector;

use Iterator;
use Rector\DeadCode\Rector\Function_\RemoveUnusedFunctionRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class RemoveUnusedFunctionRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\DeadCode\Rector\Function_\RemoveUnusedFunctionRector::class;
    }
}
