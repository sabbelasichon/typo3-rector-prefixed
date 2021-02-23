<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\Rector\v10\v4;

use PhpParser\Node;
use PhpParser\Node\Expr\ErrorSuppress;
use PhpParser\Node\Expr\StaticCall;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 * @see https://docs.typo3.org/c/typo3/cms-core/master/en-us/Changelog/10.4/Deprecation-90956-AlternativeFetchMethodsAndReportsForGeneralUtilitygetUrl.html
 */
final class UseFileGetContentsForGetUrlRector extends \Rector\Core\Rector\AbstractRector
{
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Expr\StaticCall::class];
    }
    /**
     * @param StaticCall $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->nodeTypeResolver->isMethodStaticCallOrClassMethodObjectType($node, \TYPO3\CMS\Core\Utility\GeneralUtility::class)) {
            return null;
        }
        if (!$this->isName($node->name, 'getUrl')) {
            return null;
        }
        // Only calls with the url argument are rewritten
        if (\count($node->args) > 1) {
            return null;
        }
        $urlValue = $this->valueResolver->getValue($node->args[0]->value);
        if (null === $urlValue) {
            return null;
        }
        // Cannot rewrite for external urls
        if (\preg_match('#^(?:http|ftp)s?|s(?:ftp|cp):#', $urlValue)) {
            return $this->nodeFactory->createMethodCall($this->nodeFactory->createMethodCall($this->nodeFactory->createMethodCall($this->nodeFactory->createStaticCall(\TYPO3\CMS\Core\Utility\GeneralUtility::class, 'makeInstance', [$this->nodeFactory->createClassConstReference(\TYPO3\CMS\Core\Http\RequestFactory::class)]), 'request', $node->args), 'getBody'), 'getContents');
        }
        return new \PhpParser\Node\Expr\ErrorSuppress($this->nodeFactory->createFuncCall('file_get_contents', $node->args));
    }
    /**
     * @codeCoverageIgnore
     */
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Rewirte Method Calls of GeneralUtility::getUrl("somefile.csv") to @file_get_contents', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'PHP'
use TYPO3\CMS\Core\Utility\GeneralUtility;

GeneralUtility::getUrl('some.csv');
$externalUrl = 'https://domain.com';
GeneralUtility::getUrl($externalUrl);

PHP
, <<<'PHP'
use TYPO3\CMS\Core\Http\RequestFactory;

@file_get_contents('some.csv');
$externalUrl = 'https://domain.com';
GeneralUtility::makeInstance(RequestFactory::class)->request($externalUrl)->getBody()->getContents();

PHP
)]);
    }
}
