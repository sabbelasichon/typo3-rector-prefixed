<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311\Symplify\SetConfigResolver\Tests\ConfigResolver\Source;

use Typo3RectorPrefix20210311\Symplify\SetConfigResolver\Contract\SetProviderInterface;
use Typo3RectorPrefix20210311\Symplify\SetConfigResolver\Provider\AbstractSetProvider;
use Typo3RectorPrefix20210311\Symplify\SetConfigResolver\ValueObject\Set;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class DummySetProvider extends \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\Provider\AbstractSetProvider implements \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\Contract\SetProviderInterface
{
    /**
     * @var Set[]
     */
    private $sets = [];
    public function __construct()
    {
        $this->sets[] = new \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\ValueObject\Set('some_set', new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo(__DIR__ . '/../Source/some_set.yaml'));
        $this->sets[] = new \Typo3RectorPrefix20210311\Symplify\SetConfigResolver\ValueObject\Set('some_php_set', new \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo(__DIR__ . '/../Source/some_php_set.php'));
    }
    /**
     * @return Set[]
     */
    public function provide() : array
    {
        return $this->sets;
    }
}
