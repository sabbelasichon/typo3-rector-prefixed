<?php

declare (strict_types=1);
namespace Rector\Nette\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\String_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @sponsor Thanks https://amateri.com for sponsoring this rule - visit them on https://www.startupjobs.cz/startup/scrumworks-s-r-o
 *
 * @see \Rector\Nette\Tests\Rector\MethodCall\AddNextrasDatePickerToDateControlRector\AddNextrasDatePickerToDateControlRectorTest
 */
final class AddNextrasDatePickerToDateControlRector extends \Rector\Core\Rector\AbstractRector
{
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Nextras/Form upgrade of addDatePicker method call to DateControl assign', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
use Nette\Application\UI\Form;

class SomeClass
{
    public function run()
    {
        $form = new Form();
        $form->addDatePicker('key', 'Label');
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Nette\Application\UI\Form;

class SomeClass
{
    public function run()
    {
        $form = new Form();
        $form['key'] = new \Nextras\FormComponents\Controls\DateControl('Label');
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
        // 1. chain call
        if ($node->var instanceof \PhpParser\Node\Expr\MethodCall) {
            if (!$this->isOnClassMethodCall($node->var, 'Typo3RectorPrefix20210311\\Nette\\Application\\UI\\Form', 'addDatePicker')) {
                return null;
            }
            $assign = $this->createAssign($node->var);
            if (!$assign instanceof \PhpParser\Node) {
                return null;
            }
            $controlName = $this->resolveControlName($node->var);
            $node->var = new \PhpParser\Node\Expr\Variable($controlName);
            // this fixes printing indent
            $node->setAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::ORIGINAL_NODE, null);
            $this->addNodeBeforeNode($assign, $node);
            return $node;
        }
        // 2. assign call
        if (!$this->isOnClassMethodCall($node, 'Typo3RectorPrefix20210311\\Nette\\Application\\UI\\Form', 'addDatePicker')) {
            return null;
        }
        return $this->createAssign($node);
    }
    private function createAssign(\PhpParser\Node\Expr\MethodCall $methodCall) : ?\PhpParser\Node
    {
        $key = $methodCall->args[0]->value;
        if (!$key instanceof \PhpParser\Node\Scalar\String_) {
            return null;
        }
        $new = $this->createDateTimeControlNew($methodCall);
        $parent = $methodCall->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::PARENT_NODE);
        if ($parent instanceof \PhpParser\Node\Expr\Assign) {
            return $new;
        }
        $arrayDimFetch = new \PhpParser\Node\Expr\ArrayDimFetch($methodCall->var, $key);
        $new = $this->createDateTimeControlNew($methodCall);
        $formAssign = new \PhpParser\Node\Expr\Assign($arrayDimFetch, $new);
        if ($parent !== null) {
            $methodCalls = $this->betterNodeFinder->findInstanceOf($parent, \PhpParser\Node\Expr\MethodCall::class);
            if (\count($methodCalls) > 1) {
                $controlName = $this->resolveControlName($methodCall);
                return new \PhpParser\Node\Expr\Assign(new \PhpParser\Node\Expr\Variable($controlName), $formAssign);
            }
        }
        return $formAssign;
    }
    private function resolveControlName(\PhpParser\Node\Expr\MethodCall $methodCall) : string
    {
        $controlName = $methodCall->args[0]->value;
        if (!$controlName instanceof \PhpParser\Node\Scalar\String_) {
            throw new \Rector\Core\Exception\ShouldNotHappenException();
        }
        return $controlName->value . 'DateControl';
    }
    private function createDateTimeControlNew(\PhpParser\Node\Expr\MethodCall $methodCall) : \PhpParser\Node\Expr\New_
    {
        $fullyQualified = new \PhpParser\Node\Name\FullyQualified('Typo3RectorPrefix20210311\\Nextras\\FormComponents\\Controls\\DateControl');
        $new = new \PhpParser\Node\Expr\New_($fullyQualified);
        if (isset($methodCall->args[1])) {
            $new->args[] = $methodCall->args[1];
        }
        return $new;
    }
}
