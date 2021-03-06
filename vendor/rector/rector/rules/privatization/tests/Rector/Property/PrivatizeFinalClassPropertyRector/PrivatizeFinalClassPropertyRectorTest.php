<?php

declare (strict_types=1);
namespace Rector\Privatization\Tests\Rector\Property\PrivatizeFinalClassPropertyRector;

use Iterator;
use Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class PrivatizeFinalClassPropertyRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Privatization\Rector\Property\PrivatizeFinalClassPropertyRector::class;
    }
}
