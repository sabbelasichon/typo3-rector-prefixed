<?php

declare (strict_types=1);
namespace Rector\AttributeAwarePhpDoc\AttributeAwareNodeFactory\PhpDoc;

use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;
use Rector\AttributeAwarePhpDoc\Ast\PhpDoc\AttributeAwareThrowsTagValueNode;
use Rector\AttributeAwarePhpDoc\Contract\AttributeNodeAwareFactory\AttributeAwareNodeFactoryAwareInterface;
use Rector\AttributeAwarePhpDoc\Contract\AttributeNodeAwareFactory\AttributeNodeAwareFactoryInterface;
use Rector\BetterPhpDocParser\Attributes\Ast\AttributeAwareNodeFactory;
use Rector\BetterPhpDocParser\Contract\PhpDocNode\AttributeAwareNodeInterface;
final class AttributeAwareThrowsTagValueNodeFactory implements \Rector\AttributeAwarePhpDoc\Contract\AttributeNodeAwareFactory\AttributeNodeAwareFactoryInterface, \Rector\AttributeAwarePhpDoc\Contract\AttributeNodeAwareFactory\AttributeAwareNodeFactoryAwareInterface
{
    /**
     * @var AttributeAwareNodeFactory
     */
    private $attributeAwareNodeFactory;
    public function getOriginalNodeClass() : string
    {
        return \PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode::class;
    }
    public function isMatch(\PHPStan\PhpDocParser\Ast\Node $node) : bool
    {
        return \is_a($node, \PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode::class, \true);
    }
    /**
     * @param ThrowsTagValueNode $node
     */
    public function create(\PHPStan\PhpDocParser\Ast\Node $node, string $docContent) : \Rector\BetterPhpDocParser\Contract\PhpDocNode\AttributeAwareNodeInterface
    {
        $node->type = $this->attributeAwareNodeFactory->createFromNode($node->type, $docContent);
        return new \Rector\AttributeAwarePhpDoc\Ast\PhpDoc\AttributeAwareThrowsTagValueNode($node->type, $node->description);
    }
    public function setAttributeAwareNodeFactory(\Rector\BetterPhpDocParser\Attributes\Ast\AttributeAwareNodeFactory $attributeAwareNodeFactory) : void
    {
        $this->attributeAwareNodeFactory = $attributeAwareNodeFactory;
    }
}
