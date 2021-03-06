<?php

declare (strict_types=1);
namespace Rector\Generics\Tests\Rector\Class_\GenericsPHPStormMethodAnnotationRector;

use Iterator;
use Rector\Generics\Rector\Class_\GenericsPHPStormMethodAnnotationRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class GenericsPHPStormMethodAnnotationRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Generics\Rector\Class_\GenericsPHPStormMethodAnnotationRector::class;
    }
}
