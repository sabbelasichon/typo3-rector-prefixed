<?php

declare (strict_types=1);
namespace Rector\Laravel\Tests\Rector\New_\MakeTaggedPassedToParameterIterableTypeRector;

use Iterator;
use Rector\Laravel\Rector\New_\MakeTaggedPassedToParameterIterableTypeRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class MakeTaggedPassedToParameterIterableTypeRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Laravel\Rector\New_\MakeTaggedPassedToParameterIterableTypeRector::class;
    }
}
