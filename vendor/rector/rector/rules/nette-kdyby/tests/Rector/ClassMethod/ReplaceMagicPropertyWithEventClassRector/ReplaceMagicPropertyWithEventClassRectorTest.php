<?php

declare (strict_types=1);
namespace Rector\NetteKdyby\Tests\Rector\ClassMethod\ReplaceMagicPropertyWithEventClassRector;

use Rector\NetteKdyby\Rector\ClassMethod\ReplaceMagicPropertyWithEventClassRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class ReplaceMagicPropertyWithEventClassRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
{
    public function test() : void
    {
        $fixtureFileInfo = new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo(__DIR__ . '/Fixture/fixture.php.inc');
        $this->doTestFileInfo($fixtureFileInfo);
    }
    protected function getRectorClass() : string
    {
        return \Rector\NetteKdyby\Rector\ClassMethod\ReplaceMagicPropertyWithEventClassRector::class;
    }
}
