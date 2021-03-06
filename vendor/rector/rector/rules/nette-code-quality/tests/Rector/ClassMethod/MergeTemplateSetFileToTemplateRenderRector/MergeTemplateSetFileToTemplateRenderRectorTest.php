<?php

declare (strict_types=1);
namespace Rector\NetteCodeQuality\Tests\Rector\ClassMethod\MergeTemplateSetFileToTemplateRenderRector;

use Iterator;
use Rector\NetteCodeQuality\Rector\ClassMethod\MergeTemplateSetFileToTemplateRenderRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class MergeTemplateSetFileToTemplateRenderRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\NetteCodeQuality\Rector\ClassMethod\MergeTemplateSetFileToTemplateRenderRector::class;
    }
}
