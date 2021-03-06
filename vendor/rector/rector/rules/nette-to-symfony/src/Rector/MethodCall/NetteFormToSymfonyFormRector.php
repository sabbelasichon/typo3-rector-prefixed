<?php

declare (strict_types=1);
namespace Rector\NetteToSymfony\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Identifier;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassLike;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see https://doc.nette.org/en/2.4/forms
 * ↓
 * @see https://symfony.com/doc/current/forms.html
 *
 * @see https://github.com/nette/forms/blob/master/src/Forms/Container.php
 * ↓
 * @see https://github.com/symfony/symfony/tree/master/src/Symfony/Component/Form/Extension/Core/Type
 * @see \Rector\NetteToSymfony\Tests\Rector\MethodCall\NetteFormToSymfonyFormRector\NetteFormToSymfonyFormRectorTest
 */
final class NetteFormToSymfonyFormRector extends \Rector\Core\Rector\AbstractRector
{
    /**
     * @var string[]
     */
    private const ADD_METHOD_TO_FORM_TYPE = [
        'addText' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType',
        'addPassword' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\PasswordType',
        'addTextArea' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\TextareaType',
        'addEmail' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\EmailType',
        'addInteger' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType',
        'addHidden' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\HiddenType',
        // https://symfony.com/doc/current/reference/forms/types/checkbox.html
        'addCheckbox' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType',
        'addUpload' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\FileType',
        'addImage' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\FileType',
        'addMultiUpload' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\FileType',
        // https://symfony.com/doc/current/reference/forms/types/choice.html#select-tag-checkboxes-or-radio-buttons
        'addSelect' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType',
        'addRadioList' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType',
        'addCheckboxList' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType',
        'addMultiSelect' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType',
        'addSubmit' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\SubmitType',
        'addButton' => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Form\\Extension\\Core\\Type\\ButtonType',
    ];
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Migrate Nette\\Forms in Presenter to Symfony', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
use Nette\Application\UI;

class SomePresenter extends UI\Presenter
{
    public function someAction()
    {
        $form = new UI\Form;
        $form->addText('name', 'Name:');
        $form->addPassword('password', 'Password:');
        $form->addSubmit('login', 'Sign up');
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Nette\Application\UI;

class SomePresenter extends UI\Presenter
{
    public function someAction()
    {
        $form = $this->createFormBuilder();
        $form->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
            'label' => 'Name:'
        ]);
        $form->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, [
            'label' => 'Password:'
        ]);
        $form->add('login', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, [
            'label' => 'Sign up'
        ]);
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
        return [\PhpParser\Node\Expr\New_::class, \PhpParser\Node\Expr\MethodCall::class];
    }
    /**
     * @param New_|MethodCall $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $classLike = $node->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::CLASS_NODE);
        if (!$classLike instanceof \PhpParser\Node\Stmt\ClassLike) {
            return null;
        }
        if (!$this->isObjectType($classLike, 'Typo3RectorPrefix20210311\\Nette\\Application\\IPresenter')) {
            return null;
        }
        if ($node instanceof \PhpParser\Node\Expr\New_) {
            return $this->processNew($node);
        }
        /** @var MethodCall $node */
        if (!$this->isObjectType($node->var, 'Typo3RectorPrefix20210311\\Nette\\Application\\UI\\Form')) {
            return null;
        }
        foreach (self::ADD_METHOD_TO_FORM_TYPE as $method => $classType) {
            if (!$this->isName($node->name, $method)) {
                continue;
            }
            $this->processAddMethod($node, $method, $classType);
        }
        return $node;
    }
    private function processNew(\PhpParser\Node\Expr\New_ $new) : ?\PhpParser\Node\Expr\MethodCall
    {
        if (!$this->isName($new->class, 'Typo3RectorPrefix20210311\\Nette\\Application\\UI\\Form')) {
            return null;
        }
        return $this->nodeFactory->createMethodCall('this', 'createFormBuilder');
    }
    private function processAddMethod(\PhpParser\Node\Expr\MethodCall $methodCall, string $method, string $classType) : void
    {
        $methodCall->name = new \PhpParser\Node\Identifier('add');
        // remove unused params
        if ($method === 'addText') {
            unset($methodCall->args[3], $methodCall->args[4]);
        }
        // has label
        $optionsArray = new \PhpParser\Node\Expr\Array_();
        if (isset($methodCall->args[1])) {
            $optionsArray->items[] = new \PhpParser\Node\Expr\ArrayItem($methodCall->args[1]->value, new \PhpParser\Node\Scalar\String_('label'));
        }
        $this->addChoiceTypeOptions($method, $optionsArray);
        $this->addMultiFileTypeOptions($method, $optionsArray);
        $methodCall->args[1] = new \PhpParser\Node\Arg($this->nodeFactory->createClassConstReference($classType));
        if ($optionsArray->items !== []) {
            $methodCall->args[2] = new \PhpParser\Node\Arg($optionsArray);
        }
    }
    private function addChoiceTypeOptions(string $method, \PhpParser\Node\Expr\Array_ $optionsArray) : void
    {
        if ($method === 'addSelect') {
            $expanded = \false;
            $multiple = \false;
        } elseif ($method === 'addRadioList') {
            $expanded = \true;
            $multiple = \false;
        } elseif ($method === 'addCheckboxList') {
            $expanded = \true;
            $multiple = \true;
        } elseif ($method === 'addMultiSelect') {
            $expanded = \false;
            $multiple = \true;
        } else {
            return;
        }
        $optionsArray->items[] = new \PhpParser\Node\Expr\ArrayItem($expanded ? $this->nodeFactory->createTrue() : $this->nodeFactory->createFalse(), new \PhpParser\Node\Scalar\String_('expanded'));
        $optionsArray->items[] = new \PhpParser\Node\Expr\ArrayItem($multiple ? $this->nodeFactory->createTrue() : $this->nodeFactory->createFalse(), new \PhpParser\Node\Scalar\String_('multiple'));
    }
    private function addMultiFileTypeOptions(string $method, \PhpParser\Node\Expr\Array_ $optionsArray) : void
    {
        if ($method !== 'addMultiUpload') {
            return;
        }
        $optionsArray->items[] = new \PhpParser\Node\Expr\ArrayItem($this->nodeFactory->createTrue(), new \PhpParser\Node\Scalar\String_('multiple'));
    }
}
