<?php

declare (strict_types=1);
namespace Rector\AttributeAwarePhpDoc\Ast\PhpDoc;

use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocChildNode;
use Rector\BetterPhpDocParser\Attributes\Attribute\AttributeTrait;
use Rector\BetterPhpDocParser\Contract\PhpDocNode\AttributeAwareNodeInterface;
use Typo3RectorPrefix20210311\Symplify\SimplePhpDocParser\ValueObject\Ast\PhpDoc\SimplePhpDocNode;
final class AttributeAwarePhpDocNode extends \Typo3RectorPrefix20210311\Symplify\SimplePhpDocParser\ValueObject\Ast\PhpDoc\SimplePhpDocNode implements \Rector\BetterPhpDocParser\Contract\PhpDocNode\AttributeAwareNodeInterface
{
    use AttributeTrait;
    /**
     * @var PhpDocChildNode[]|AttributeAwareNodeInterface[]
     */
    public $children = [];
    public function __toString() : string
    {
        return "/**\n * " . \implode("\n * ", $this->children) . "\n */";
    }
}
