<?php

declare (strict_types=1);
namespace Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\PropertyFetchTypeResolver;

use PhpParser\Node\Expr\PropertyFetch;
use PHPStan\Type\Type;
use PHPStan\Type\VerbosityLevel;
use Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\AbstractNodeTypeResolverTest;
use Typo3RectorPrefix20210311\Symplify\EasyTesting\StaticFixtureSplitter;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
abstract class AbstractPropertyFetchTypeResolverTest extends \Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\AbstractNodeTypeResolverTest
{
    protected function doTestFileInfo(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : void
    {
        $inputFileInfoAndExpectedFileInfo = \Typo3RectorPrefix20210311\Symplify\EasyTesting\StaticFixtureSplitter::splitFileInfoToLocalInputAndExpectedFileInfos($smartFileInfo);
        $inputFileInfo = $inputFileInfoAndExpectedFileInfo->getInputFileInfo();
        $expectedFileInfo = $inputFileInfoAndExpectedFileInfo->getExpectedFileInfo();
        $propertyFetchNodes = $this->getNodesForFileOfType($inputFileInfo->getRealPath(), \PhpParser\Node\Expr\PropertyFetch::class);
        $resolvedType = $this->nodeTypeResolver->resolve($propertyFetchNodes[0]);
        $expectedType = (include $expectedFileInfo->getRealPath());
        $expectedTypeAsString = $this->getStringFromType($expectedType);
        $resolvedTypeAsString = $this->getStringFromType($resolvedType);
        $this->assertSame($expectedTypeAsString, $resolvedTypeAsString);
    }
    private function getStringFromType(\PHPStan\Type\Type $type) : string
    {
        return $type->describe(\PHPStan\Type\VerbosityLevel::precise());
    }
}
