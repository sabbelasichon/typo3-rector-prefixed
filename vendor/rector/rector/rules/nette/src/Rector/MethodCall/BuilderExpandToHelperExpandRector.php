<?php

declare (strict_types=1);
namespace Rector\Nette\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @sponsor Thanks https://amateri.com for sponsoring this rule - visit them on https://www.startupjobs.cz/startup/scrumworks-s-r-o
 *
 * @see https://github.com/Kdyby/Doctrine/commit/db80bf77c0b68af88dfe7eddb2cb2db94aedb04a#diff-ccc8ba07edfa3a425ddfe564acb50656R291
 *
 * @see \Rector\Nette\Tests\Rector\MethodCall\BuilderExpandToHelperExpandRector\BuilderExpandToHelperExpandRectorTest
 */
final class BuilderExpandToHelperExpandRector extends \Rector\Core\Rector\AbstractRector
{
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Change containerBuilder->expand() to static call with parameters', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
use Nette\DI\CompilerExtension;

final class SomeClass extends CompilerExtension
{
    public function loadConfiguration()
    {
        $value = $this->getContainerBuilder()->expand('%value');
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Nette\DI\CompilerExtension;

final class SomeClass extends CompilerExtension
{
    public function loadConfiguration()
    {
        $value = \Nette\DI\Helpers::expand('%value', $this->getContainerBuilder()->parameters);
    }
}
CODE_SAMPLE
)]);
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Expr\MethodCall::class];
    }
    /**
     * @param MethodCall $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->isOnClassMethodCall($node, 'Typo3RectorPrefix20210311\\Nette\\DI\\ContainerBuilder', 'expand')) {
            return null;
        }
        $args = $node->args;
        $getContainerBuilderMethodCall = new \PhpParser\Node\Expr\MethodCall(new \PhpParser\Node\Expr\Variable('this'), 'getContainerBuilder');
        $parametersPropertyFetch = new \PhpParser\Node\Expr\PropertyFetch($getContainerBuilderMethodCall, 'parameters');
        $args[] = new \PhpParser\Node\Arg($parametersPropertyFetch);
        return new \PhpParser\Node\Expr\StaticCall(new \PhpParser\Node\Name\FullyQualified('Typo3RectorPrefix20210311\\Nette\\DI\\Helpers'), 'expand', $args);
    }
}
