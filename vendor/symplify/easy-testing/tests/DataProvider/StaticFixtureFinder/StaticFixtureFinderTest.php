<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223\Symplify\EasyTesting\Tests\DataProvider\StaticFixtureFinder;

use Typo3RectorPrefix20210223\PHPUnit\Framework\TestCase;
use Typo3RectorPrefix20210223\Symplify\EasyTesting\DataProvider\StaticFixtureFinder;
use Typo3RectorPrefix20210223\Symplify\SymplifyKernel\Exception\ShouldNotHappenException;
final class StaticFixtureFinderTest extends \Typo3RectorPrefix20210223\PHPUnit\Framework\TestCase
{
    public function testYieldDirectory() : void
    {
        $files = \Typo3RectorPrefix20210223\Symplify\EasyTesting\DataProvider\StaticFixtureFinder::yieldDirectory(__DIR__ . '/Fixture', '*.php');
        $files = \iterator_to_array($files);
        $this->assertCount(1, $files);
    }
    public function testYieldDirectoryThrowException() : void
    {
        $files = \Typo3RectorPrefix20210223\Symplify\EasyTesting\DataProvider\StaticFixtureFinder::yieldDirectory(__DIR__ . '/FixtureMulti', '*.php');
        $files = \iterator_to_array($files);
        $this->assertCount(1, $files);
    }
    public function testYieldDirectoryExclusivelyThrowException() : void
    {
        $this->expectException(\Typo3RectorPrefix20210223\Symplify\SymplifyKernel\Exception\ShouldNotHappenException::class);
        $files = \Typo3RectorPrefix20210223\Symplify\EasyTesting\DataProvider\StaticFixtureFinder::yieldDirectoryExclusively(__DIR__ . '/FixtureMulti', '*.php');
        // this is needed to call the iterator
        $fileInfos = \iterator_to_array($files);
    }
}
