<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\Rector\v7\v6;

use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Ssch\TYPO3Rector\Helper\TcaHelperTrait;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/7.6/Deprecation-69822-DeprecateSelectFieldTca.html
 */
final class AddRenderTypeToSelectFieldRector extends \Rector\Core\Rector\AbstractRector
{
    use TcaHelperTrait;
    /**
     * @var string
     */
    private const RENDER_TYPE = 'renderType';
    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Add renderType for select fields', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
return [
    'ctrl' => [
    ],
    'columns' => [
        'sys_language_uid' => [
            'config' => [
                'type' => 'select',
                'maxitems' => 1,
            ],
        ],
    ],
];
CODE_SAMPLE
, <<<'CODE_SAMPLE'
return [
    'ctrl' => [
    ],
    'columns' => [
        'sys_language_uid' => [
            'config' => [
                'type' => 'select',
                'maxitems' => 1,
                'renderType' => 'selectSingle',
            ],
        ],
    ],
];
CODE_SAMPLE
)]);
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Stmt\Return_::class];
    }
    /**
     * @param Return_ $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->isTca($node)) {
            return null;
        }
        $columns = $this->extractColumns($node);
        if (!$columns instanceof \PhpParser\Node\Expr\ArrayItem) {
            return null;
        }
        $items = $columns->value;
        if (!$items instanceof \PhpParser\Node\Expr\Array_) {
            return null;
        }
        $hasAstBeenChanged = \false;
        foreach ($items->items as $fieldValue) {
            if (!$fieldValue instanceof \PhpParser\Node\Expr\ArrayItem) {
                continue;
            }
            if (null === $fieldValue->key) {
                continue;
            }
            $fieldName = $this->valueResolver->getValue($fieldValue->key);
            if (null === $fieldName) {
                continue;
            }
            if (!$fieldValue->value instanceof \PhpParser\Node\Expr\Array_) {
                continue;
            }
            foreach ($fieldValue->value->items as $configValue) {
                if (null === $configValue) {
                    continue;
                }
                if (!$configValue->value instanceof \PhpParser\Node\Expr\Array_) {
                    continue;
                }
                $configType = null;
                $renderMode = null;
                $maxItems = 1;
                $renderType = null;
                foreach ($configValue->value->items as $configItemValue) {
                    if (!$configItemValue instanceof \PhpParser\Node\Expr\ArrayItem) {
                        continue;
                    }
                    if (null === $configItemValue->key) {
                        continue;
                    }
                    if ($this->valueResolver->isValue($configItemValue->key, 'type')) {
                        $configType = $this->valueResolver->getValue($configItemValue->value);
                    } elseif ($this->valueResolver->isValue($configItemValue->key, 'renderMode')) {
                        $renderMode = $this->valueResolver->getValue($configItemValue->value);
                    } elseif ($this->valueResolver->isValue($configItemValue->key, 'maxitems')) {
                        $maxItems = $this->valueResolver->getValue($configItemValue->value);
                    } elseif ($this->valueResolver->isValue($configItemValue->key, self::RENDER_TYPE)) {
                        $renderType = $this->valueResolver->getValue($configItemValue->value);
                    }
                }
                if ('select' !== $configType) {
                    continue;
                }
                // If the renderType is already set, do nothing
                if (null !== $renderType) {
                    continue;
                }
                if (null !== $renderMode) {
                    $renderType = null;
                    switch ($renderMode) {
                        case 'tree':
                            $renderType = 'selectTree';
                            break;
                        case 'singlebox':
                            $renderType = 'selectSingleBox';
                            break;
                        case 'checkbox':
                            $renderType = 'selectCheckBox';
                            break;
                        default:
                            new \Rector\Core\Exception\ShouldNotHappenException(\sprintf('The render mode %s is invalid for the select field in %s', $renderMode, $fieldName));
                            break;
                    }
                    if (null !== $renderType) {
                        $configValue->value->items[] = new \PhpParser\Node\Expr\ArrayItem(new \PhpParser\Node\Scalar\String_($renderType), new \PhpParser\Node\Scalar\String_(self::RENDER_TYPE));
                        $hasAstBeenChanged = \true;
                    }
                    continue;
                }
                $renderType = $maxItems <= 1 ? 'selectSingle' : 'selectMultipleSideBySide';
                if (null !== $renderType) {
                    $configValue->value->items[] = new \PhpParser\Node\Expr\ArrayItem(new \PhpParser\Node\Scalar\String_($renderType), new \PhpParser\Node\Scalar\String_(self::RENDER_TYPE));
                    $hasAstBeenChanged = \true;
                }
            }
        }
        return $hasAstBeenChanged ? $node : null;
    }
}
