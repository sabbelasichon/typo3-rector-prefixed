<?php

declare (strict_types=1);
namespace Rector\Php55\Tests\Rector\FuncCall\PregReplaceEModifierRector;

use Iterator;
use Rector\Php55\Rector\FuncCall\PregReplaceEModifierRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class PregReplaceEModifierRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Php55\Rector\FuncCall\PregReplaceEModifierRector::class;
    }
}
