<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\Rector\v10\v0;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Name;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Ssch\TYPO3Rector\Helper\Typo3NodeResolver;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\TypoScriptAspect;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
/**
 * @see https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/10.0/Deprecation-88792-ForceTemplateParsingInTSFEAndTemplateService.html
 * @see \Ssch\TYPO3Rector\Tests\Rector\v10\v0\ForceTemplateParsingInTsfeAndTemplateServiceRectorTest
 */
final class ForceTemplateParsingInTsfeAndTemplateServiceRector extends \Rector\Core\Rector\AbstractRector
{
    /**
     * @var string
     */
    private const MAKE_INSTANCE = 'makeInstance';
    /**
     * @var string
     */
    private const TYPOSCRIPT = 'typoscript';
    /**
     * @var Typo3NodeResolver
     */
    private $typo3NodeResolver;
    public function __construct(\Ssch\TYPO3Rector\Helper\Typo3NodeResolver $typo3NodeResolver)
    {
        $this->typo3NodeResolver = $typo3NodeResolver;
    }
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Expr\Assign::class];
    }
    /**
     * @param Assign $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if ($node instanceof \PhpParser\Node\Expr\Assign) {
            if ($this->isPropertyForceTemplateParsing($node->var)) {
                //$node->var (left side is the target property, so its an assigment to it)
                $contextCall = $this->createCallForSettingProperty();
                $this->addNodeAfterNode($contextCall, $node);
                try {
                    $this->removeNode($node);
                } catch (\Rector\Core\Exception\ShouldNotHappenException $shouldNotHappenException) {
                    $parentNode = $node->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::PARENT_NODE);
                    $this->removeNode($parentNode);
                }
                return $node;
            } elseif ($this->isPropertyForceTemplateParsing($node->expr)) {
                //$node->expr (right side is the target property, so its an fetch to it)
                $contextCall = $this->createCallForFetchingProperty();
                $node->expr = $contextCall;
                return $node;
            }
        }
        return null;
    }
    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Force template parsing in tsfe is replaced with context api and aspects', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
$myvariable = $GLOBALS['TSFE']->forceTemplateParsing;
$myvariable2 = $GLOBALS['TSFE']->tmpl->forceTemplateParsing;

$GLOBALS['TSFE']->forceTemplateParsing = true;
$GLOBALS['TSFE']->tmpl->forceTemplateParsing = true;
CODE_SAMPLE
, <<<'CODE_SAMPLE'
$myvariable = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class)->getPropertyFromAspect('typoscript', 'forcedTemplateParsing');
$myvariable2 = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class)->getPropertyFromAspect('typoscript', 'forcedTemplateParsing');

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class)->setAspect('typoscript', \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\TypoScriptAspect::class, true));
\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class)->setAspect('typoscript', \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\TypoScriptAspect::class, true));
CODE_SAMPLE
)]);
    }
    public function createCallForFetchingProperty() : \PhpParser\Node\Expr\MethodCall
    {
        $staticCallContext = $this->nodeFactory->createStaticCall(\TYPO3\CMS\Core\Utility\GeneralUtility::class, self::MAKE_INSTANCE, [$this->nodeFactory->createClassConstReference(\TYPO3\CMS\Core\Context\Context::class)]);
        $staticCallAspect = $this->nodeFactory->createStaticCall(\TYPO3\CMS\Core\Utility\GeneralUtility::class, self::MAKE_INSTANCE, [$this->nodeFactory->createClassConstReference(\TYPO3\CMS\Core\Context\TypoScriptAspect::class), new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('true'))]);
        $contextCall = $this->nodeFactory->createMethodCall($staticCallContext, 'setAspect');
        $contextCall->args = $this->nodeFactory->createArgs([self::TYPOSCRIPT, $staticCallAspect]);
        $contextCall = $this->nodeFactory->createMethodCall($staticCallContext, 'getPropertyFromAspect');
        $contextCall->args = $this->nodeFactory->createArgs([self::TYPOSCRIPT, 'forcedTemplateParsing']);
        return $contextCall;
    }
    public function createCallForSettingProperty() : \PhpParser\Node\Expr\MethodCall
    {
        $staticCallContext = $this->nodeFactory->createStaticCall(\TYPO3\CMS\Core\Utility\GeneralUtility::class, self::MAKE_INSTANCE, [$this->nodeFactory->createClassConstReference(\TYPO3\CMS\Core\Context\Context::class)]);
        $staticCallAspect = $this->nodeFactory->createStaticCall(\TYPO3\CMS\Core\Utility\GeneralUtility::class, self::MAKE_INSTANCE, [$this->nodeFactory->createClassConstReference(\TYPO3\CMS\Core\Context\TypoScriptAspect::class), new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('true'))]);
        $contextCall = $this->nodeFactory->createMethodCall($staticCallContext, 'setAspect');
        $contextCall->args = $this->nodeFactory->createArgs([self::TYPOSCRIPT, $staticCallAspect]);
        return $contextCall;
    }
    private function isPropertyForceTemplateParsing(\PhpParser\Node $node) : bool
    {
        return ($this->isObjectType($node, \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::class) || $this->isObjectType($node, \TYPO3\CMS\Core\TypoScript\TemplateService::class) || $this->typo3NodeResolver->isPropertyFetchOnAnyPropertyOfGlobals($node, \Ssch\TYPO3Rector\Helper\Typo3NodeResolver::TYPO_SCRIPT_FRONTEND_CONTROLLER) || \property_exists($node, 'var') && $this->typo3NodeResolver->isPropertyFetchOnAnyPropertyOfGlobals($node->var, \Ssch\TYPO3Rector\Helper\Typo3NodeResolver::TYPO_SCRIPT_FRONTEND_CONTROLLER)) && (\property_exists($node, 'name') && $this->isName($node, 'forceTemplateParsing'));
    }
}
