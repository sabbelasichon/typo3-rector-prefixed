<?php

declare (strict_types=1);
namespace Rector\TypeDeclaration\Tests\Rector\FunctionLike\ParamTypeDeclarationRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class UnionTypeParamTypeDeclarationRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return $this->yieldFilesFromDirectory(__DIR__ . '/FixtureUnionType');
    }
    protected function getRectorClass() : string
    {
        return \Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector::class;
    }
}
