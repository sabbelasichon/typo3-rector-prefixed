<?php

declare (strict_types=1);
namespace Rector\Nette\Tests\Rector\MethodCall\MagicHtmlCallToAppendAttributeRector;

use Iterator;
use Rector\Nette\Rector\MethodCall\MagicHtmlCallToAppendAttributeRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class MagicHtmlCallToAppendAttributeRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Nette\Rector\MethodCall\MagicHtmlCallToAppendAttributeRector::class;
    }
}
