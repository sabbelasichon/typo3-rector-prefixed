<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_;

use Rector\BetterPhpDocParser\Contract\Doctrine\InversedByNodeInterface;
use Rector\BetterPhpDocParser\Contract\Doctrine\MappedByNodeInterface;
use Rector\BetterPhpDocParser\Contract\Doctrine\ToOneTagNodeInterface;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\AbstractDoctrineTagValueNode;
final class OneToOneTagValueNode extends \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\AbstractDoctrineTagValueNode implements \Rector\BetterPhpDocParser\Contract\Doctrine\ToOneTagNodeInterface, \Rector\BetterPhpDocParser\Contract\Doctrine\MappedByNodeInterface, \Rector\BetterPhpDocParser\Contract\Doctrine\InversedByNodeInterface
{
    /**
     * @var string|null
     */
    private $fullyQualifiedTargetEntity;
    public function __construct(\Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter, \Rector\BetterPhpDocParser\Printer\TagValueNodePrinter $tagValueNodePrinter, array $items, ?string $content = null, ?string $fullyQualifiedTargetEntity = null)
    {
        $this->fullyQualifiedTargetEntity = $fullyQualifiedTargetEntity;
        parent::__construct($arrayPartPhpDocTagPrinter, $tagValueNodePrinter, $items, $content);
    }
    public function getTargetEntity() : ?string
    {
        return $this->items['targetEntity'];
    }
    public function getFullyQualifiedTargetEntity() : ?string
    {
        return $this->fullyQualifiedTargetEntity;
    }
    public function getInversedBy() : ?string
    {
        return $this->items['inversedBy'];
    }
    public function getMappedBy() : ?string
    {
        return $this->items['mappedBy'];
    }
    public function removeInversedBy() : void
    {
        $this->items['inversedBy'] = null;
    }
    public function removeMappedBy() : void
    {
        $this->items['mappedBy'] = null;
    }
    public function changeTargetEntity(string $targetEntity) : void
    {
        $this->items['targetEntity'] = $targetEntity;
    }
    public function getShortName() : string
    {
        return 'Typo3RectorPrefix20210311\\@ORM\\OneToOne';
    }
}
