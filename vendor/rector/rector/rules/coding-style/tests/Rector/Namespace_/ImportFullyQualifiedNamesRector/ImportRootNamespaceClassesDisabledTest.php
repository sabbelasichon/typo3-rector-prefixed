<?php

declare (strict_types=1);
namespace Rector\CodingStyle\Tests\Rector\Namespace_\ImportFullyQualifiedNamesRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
/**
 * @see \Rector\PostRector\Rector\NameImportingPostRector
 */
final class ImportRootNamespaceClassesDisabledTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $fileInfo) : void
    {
        $this->doTestFileInfo($fileInfo);
    }
    /**
     * @return Iterator
     */
    public function provideData() : iterable
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/FixtureRoot');
    }
    protected function provideConfigFilePath() : string
    {
        return __DIR__ . '/config/not_import_short_classes.php';
    }
}
