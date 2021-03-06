<?php

declare (strict_types=1);
namespace Rector\Defluent\Tests\Rector\MethodCall\InArgChainFluentMethodCallToStandaloneMethodCallRectorTest;

use Iterator;
use Rector\Defluent\Rector\MethodCall\InArgFluentChainMethodCallToStandaloneMethodCallRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class InArgChainFluentMethodCallToStandaloneMethodCallRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Defluent\Rector\MethodCall\InArgFluentChainMethodCallToStandaloneMethodCallRector::class;
    }
}
