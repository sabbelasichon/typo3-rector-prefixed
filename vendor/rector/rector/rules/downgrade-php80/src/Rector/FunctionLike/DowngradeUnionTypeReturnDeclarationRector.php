<?php

declare (strict_types=1);
namespace Rector\DowngradePhp80\Rector\FunctionLike;

use PhpParser\Node\FunctionLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\UnionType;
use Rector\DowngradePhp70\Rector\FunctionLike\AbstractDowngradeReturnDeclarationRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Rector\DowngradePhp80\Tests\Rector\FunctionLike\DowngradeUnionTypeReturnDeclarationRector\DowngradeUnionTypeReturnDeclarationRectorTest
 */
final class DowngradeUnionTypeReturnDeclarationRector extends \Rector\DowngradePhp70\Rector\FunctionLike\AbstractDowngradeReturnDeclarationRector
{
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Remove returning union types, add a @return tag instead', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
class SomeClass
{
    public function getSomeObject(bool $flag): string|int
    {
        if ($flag) {
            return 1;
        }
        return 'Hello world';
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
class SomeClass
{
    /**
     * @return string|int
     */
    public function getSomeObject(bool $flag)
    {
        if ($flag) {
            return 1;
        }
        return 'Hello world';
    }
}
CODE_SAMPLE
)]);
    }
    /**
     * @param ClassMethod|Function_ $functionLike
     */
    public function shouldRemoveReturnDeclaration(\PhpParser\Node\FunctionLike $functionLike) : bool
    {
        if ($functionLike->returnType === null) {
            return \false;
        }
        // Check it is the union type
        return $functionLike->returnType instanceof \PhpParser\Node\UnionType;
    }
}
