<?php

declare (strict_types=1);
namespace Rector\Symfony5\Tests\Rector\Class_\LogoutHandlerToLogoutEventSubscriberRector;

use Iterator;
use Rector\Symfony5\Rector\Class_\LogoutHandlerToLogoutEventSubscriberRector;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class LogoutHandlerToLogoutEventSubscriberRectorTest extends \Rector\Testing\PHPUnit\AbstractRectorTestCase
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
        return \Rector\Symfony5\Rector\Class_\LogoutHandlerToLogoutEventSubscriberRector::class;
    }
}
