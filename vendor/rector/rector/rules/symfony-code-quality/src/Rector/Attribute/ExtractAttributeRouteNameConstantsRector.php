<?php

declare (strict_types=1);
namespace Rector\SymfonyCodeQuality\Rector\Attribute;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use Rector\Core\Rector\AbstractRector;
use Rector\FileSystemRector\ValueObject\AddedFileWithNodes;
use Rector\SymfonyCodeQuality\ConstantNameAndValueMatcher;
use Rector\SymfonyCodeQuality\ConstantNameAndValueResolver;
use Rector\SymfonyCodeQuality\NodeFactory\RouteNameClassFactory;
use Rector\SymfonyCodeQuality\ValueObject\ClassName;
use Rector\SymfonyCodeQuality\ValueObject\ConstantNameAndValue;
use Typo3RectorPrefix20210311\Symfony\Component\Routing\Annotation\Route;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ExtraFileCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem;
/**
 * @see https://tomasvotruba.com/blog/2020/12/21/5-new-combos-opened-by-symfony-52-and-php-80/
 *
 * @see \Rector\SymfonyCodeQuality\Tests\Rector\Attribute\ExtractAttributeRouteNameConstantsRector\ExtractAttributeRouteNameConstantsRectorTest
 */
final class ExtractAttributeRouteNameConstantsRector extends \Rector\Core\Rector\AbstractRector
{
    /**
     * @var string
     */
    private const ROUTE_NAME_FILE_LOCATION = 'src/ValueObject/Routing/RouteName.php';
    /**
     * @var RouteNameClassFactory
     */
    private $routeNameClassFactory;
    /**
     * @var bool
     */
    private $isRouteNameValueObjectCreated = \false;
    /**
     * @var ConstantNameAndValueMatcher
     */
    private $constantNameAndValueMatcher;
    /**
     * @var ConstantNameAndValueResolver
     */
    private $constantNameAndValueResolver;
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(\Rector\SymfonyCodeQuality\NodeFactory\RouteNameClassFactory $routeNameClassFactory, \Rector\SymfonyCodeQuality\ConstantNameAndValueMatcher $constantNameAndValueMatcher, \Rector\SymfonyCodeQuality\ConstantNameAndValueResolver $constantNameAndValueResolver, \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem $smartFileSystem)
    {
        $this->routeNameClassFactory = $routeNameClassFactory;
        $this->constantNameAndValueMatcher = $constantNameAndValueMatcher;
        $this->constantNameAndValueResolver = $constantNameAndValueResolver;
        $this->smartFileSystem = $smartFileSystem;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Extract #[Route] attribute name argument from string to constant', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ExtraFileCodeSample(<<<'CODE_SAMPLE'
use Symfony\Component\Routing\Annotation\Route;

class SomeClass
{
    #[Route(path: "path", name: "/name")]
    public function run()
    {
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Symfony\Component\Routing\Annotation\Route;

class SomeClass
{
    #[Route(path: "path", name: RouteName::NAME)]
    public function run()
    {
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
final class RouteName
{
    /**
     * @var string
     */
    public NAME = 'name';
}
CODE_SAMPLE
)]);
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Attribute::class];
    }
    /**
     * @param Attribute $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->isName($node->name, \Typo3RectorPrefix20210311\Symfony\Component\Routing\Annotation\Route::class)) {
            return null;
        }
        $this->createRouteNameValueObject();
        foreach ($node->args as $arg) {
            if (!$this->isName($arg, 'name')) {
                continue;
            }
            $constantNameAndValue = $this->constantNameAndValueMatcher->matchFromArg($arg, 'ROUTE_');
            if (!$constantNameAndValue instanceof \Rector\SymfonyCodeQuality\ValueObject\ConstantNameAndValue) {
                continue;
            }
            $arg->value = $this->nodeFactory->createClassConstFetch(\Rector\SymfonyCodeQuality\ValueObject\ClassName::ROUTE_CLASS_NAME, $constantNameAndValue->getName());
        }
        return $node;
    }
    private function createRouteNameValueObject() : void
    {
        if ($this->isRouteNameValueObjectCreated) {
            return;
        }
        if ($this->smartFileSystem->exists(self::ROUTE_NAME_FILE_LOCATION)) {
            // avoid override
            return;
        }
        $routeAttributes = $this->nodeRepository->findAttributes(\Typo3RectorPrefix20210311\Symfony\Component\Routing\Annotation\Route::class);
        $constantNameAndValues = $this->constantNameAndValueResolver->resolveFromAttributes($routeAttributes, 'ROUTE_');
        $namespace = $this->routeNameClassFactory->create($constantNameAndValues, self::ROUTE_NAME_FILE_LOCATION);
        $addedFileWithNodes = new \Rector\FileSystemRector\ValueObject\AddedFileWithNodes(self::ROUTE_NAME_FILE_LOCATION, [$namespace]);
        $this->removedAndAddedFilesCollector->addAddedFile($addedFileWithNodes);
        $this->isRouteNameValueObjectCreated = \true;
    }
}
