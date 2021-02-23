<?php

declare (strict_types=1);
namespace Rector\Naming\ValueObjectFactory;

use PhpParser\Node\Expr\ArrowFunction;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\FunctionLike;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Naming\Contract\ExpectedNameResolver\ExpectedNameResolverInterface;
use Rector\Naming\ValueObject\ParamRename;
use Rector\NodeNameResolver\NodeNameResolver;
final class ParamRenameFactory
{
    /**
     * @var NodeNameResolver
     */
    private $nodeNameResolver;
    /**
     * @var BetterNodeFinder
     */
    private $betterNodeFinder;
    public function __construct(\Rector\NodeNameResolver\NodeNameResolver $nodeNameResolver, \Rector\Core\PhpParser\Node\BetterNodeFinder $betterNodeFinder)
    {
        $this->nodeNameResolver = $nodeNameResolver;
        $this->betterNodeFinder = $betterNodeFinder;
    }
    public function create(\PhpParser\Node\Param $param, \Rector\Naming\Contract\ExpectedNameResolver\ExpectedNameResolverInterface $expectedNameResolver) : ?\Rector\Naming\ValueObject\ParamRename
    {
        $expectedName = $expectedNameResolver->resolveIfNotYet($param);
        if ($expectedName === null) {
            return null;
        }
        /** @var ClassMethod|Function_|Closure|ArrowFunction|null $functionLike */
        $functionLike = $this->betterNodeFinder->findParentType($param, \PhpParser\Node\FunctionLike::class);
        if ($functionLike === null) {
            throw new \Rector\Core\Exception\ShouldNotHappenException("There shouldn't be a param outside of FunctionLike");
        }
        if ($functionLike instanceof \PhpParser\Node\Expr\ArrowFunction) {
            return null;
        }
        $currentName = $this->nodeNameResolver->getName($param->var);
        if ($currentName === null) {
            return null;
        }
        return new \Rector\Naming\ValueObject\ParamRename($currentName, $expectedName, $param, $param->var, $functionLike);
    }
}
