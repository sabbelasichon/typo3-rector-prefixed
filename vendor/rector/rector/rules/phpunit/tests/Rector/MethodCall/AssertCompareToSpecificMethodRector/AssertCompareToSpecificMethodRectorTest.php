<?php

declare (strict_types=1);
namespace Rector\PHPUnit\Tests\Rector\MethodCall\AssertCompareToSpecificMethodRector;

use Iterator;
use Rector\PHPUnit\Rector\MethodCall\AssertCompareToSpecificMethodRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class AssertCompareToSpecificMethodRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\PHPUnit\Rector\MethodCall\AssertCompareToSpecificMethodRector::class;
    }
}
