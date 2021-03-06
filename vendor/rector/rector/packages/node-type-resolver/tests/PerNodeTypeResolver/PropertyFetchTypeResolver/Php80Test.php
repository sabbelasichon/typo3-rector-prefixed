<?php

declare (strict_types=1);
namespace Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\PropertyFetchTypeResolver;

use Iterator;
use Typo3RectorPrefix20210311\Symplify\EasyTesting\DataProvider\StaticFixtureFinder;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Rector\NodeTypeResolver\NodeTypeResolver\PropertyFetchTypeResolver
 */
final class Php80Test extends \Rector\NodeTypeResolver\Tests\PerNodeTypeResolver\PropertyFetchTypeResolver\AbstractPropertyFetchTypeResolverTest
{
    /**
     * @requires PHP 8.0
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : void
    {
        $this->doTestFileInfo($smartFileInfo);
    }
    public function provideData() : \Iterator
    {
        return \Typo3RectorPrefix20210311\Symplify\EasyTesting\DataProvider\StaticFixtureFinder::yieldDirectoryExclusively(__DIR__ . '/FixturePhp80');
    }
}
