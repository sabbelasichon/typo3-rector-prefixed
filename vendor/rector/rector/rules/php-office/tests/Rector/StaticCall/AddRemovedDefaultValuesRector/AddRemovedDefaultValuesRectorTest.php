<?php

declare (strict_types=1);
namespace Rector\PHPOffice\Tests\Rector\StaticCall\AddRemovedDefaultValuesRector;

use Iterator;
use Rector\PHPOffice\Rector\StaticCall\AddRemovedDefaultValuesRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class AddRemovedDefaultValuesRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\PHPOffice\Rector\StaticCall\AddRemovedDefaultValuesRector::class;
    }
}
