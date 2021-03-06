<?php

declare (strict_types=1);
namespace Rector\Php54\Tests\Rector\Break_\RemoveZeroBreakContinueRector;

use Iterator;
use Rector\Php54\Rector\Break_\RemoveZeroBreakContinueRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class RemoveZeroBreakContinueRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $fileInfo) : void
    {
        // to prevent loading PHP 5.4+ invalid code
        $this->doTestFileInfoWithoutAutoload($fileInfo);
    }
    public function provideData() : \Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }
    protected function getRectorClass() : string
    {
        return \Rector\Php54\Rector\Break_\RemoveZeroBreakContinueRector::class;
    }
}
