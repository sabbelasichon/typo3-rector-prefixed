<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\Tests\PhpDocParser\TagValueNodeReprint\Fixture\AssertType;

use Typo3RectorPrefix20210223\Doctrine\Common\Collections\Collection;
use Typo3RectorPrefix20210223\Symfony\Component\Validator\Constraints as Assert;
class AssertType
{
    /**
     * @var Collection
     *
     * @Assert\Type(Collection::class)
     */
    protected $effectiveDatedMessages;
}