<?php

declare (strict_types=1);
namespace Rector\RemovingStatic\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\ObjectType;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Rector\Naming\Naming\PropertyNaming;
use Rector\RemovingStatic\StaticTypesInClassResolver;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * Depends on @see PassFactoryToUniqueObjectRector
 *
 * @see \Rector\RemovingStatic\Tests\Rector\Class_\PassFactoryToEntityRector\PassFactoryToEntityRectorTest
 */
final class NewUniqueObjectToEntityFactoryRector extends \Rector\Core\Rector\AbstractRector implements \Rector\Core\Contract\Rector\ConfigurableRectorInterface
{
    /**
     * @api
     * @var string
     */
    public const TYPES_TO_SERVICES = 'types_to_services';
    /**
     * @var string
     */
    private const FACTORY = 'Factory';
    /**
     * @var ObjectType[]
     */
    private $matchedObjectTypes = [];
    /**
     * @var string[]
     */
    private $typesToServices = [];
    /**
     * @var string[]
     */
    private $classesUsingTypes = [];
    /**
     * @var PropertyNaming
     */
    private $propertyNaming;
    /**
     * @var StaticTypesInClassResolver
     */
    private $staticTypesInClassResolver;
    public function __construct(\Rector\Naming\Naming\PropertyNaming $propertyNaming, \Rector\RemovingStatic\StaticTypesInClassResolver $staticTypesInClassResolver)
    {
        $this->propertyNaming = $propertyNaming;
        $this->staticTypesInClassResolver = $staticTypesInClassResolver;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Convert new X to new factories', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample(<<<'CODE_SAMPLE'
<?php

namespace Typo3RectorPrefix20210311;

class SomeClass
{
    public function run()
    {
        return new \Typo3RectorPrefix20210311\AnotherClass();
    }
}
\class_alias('Typo3RectorPrefix20210311\\SomeClass', 'SomeClass', \false);
class AnotherClass
{
    public function someFun()
    {
        return \Typo3RectorPrefix20210311\StaticClass::staticMethod();
    }
}
\class_alias('Typo3RectorPrefix20210311\\AnotherClass', 'AnotherClass', \false);
CODE_SAMPLE
, <<<'CODE_SAMPLE'
class SomeClass
{
    public function __construct(AnotherClassFactory $anotherClassFactory)
    {
        $this->anotherClassFactory = $anotherClassFactory;
    }

    public function run()
    {
        return $this->anotherClassFactory->create();
    }
}

class AnotherClass
{
    public function someFun()
    {
        return StaticClass::staticMethod();
    }
}
CODE_SAMPLE
, [self::TYPES_TO_SERVICES => ['ClassName']])]);
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Stmt\Class_::class];
    }
    /**
     * @param Class_ $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $this->matchedObjectTypes = [];
        // collect classes with new to factory in all classes
        $classesUsingTypes = $this->resolveClassesUsingTypes();
        $this->traverseNodesWithCallable($node->stmts, function (\PhpParser\Node $node) use($classesUsingTypes) : ?MethodCall {
            if (!$node instanceof \PhpParser\Node\Expr\New_) {
                return null;
            }
            $class = $this->getName($node->class);
            if ($class === null) {
                return null;
            }
            if (!\in_array($class, $classesUsingTypes, \true)) {
                return null;
            }
            $objectType = new \Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType($class);
            $this->matchedObjectTypes[] = $objectType;
            $propertyName = $this->propertyNaming->fqnToVariableName($objectType) . self::FACTORY;
            $propertyFetch = new \PhpParser\Node\Expr\PropertyFetch(new \PhpParser\Node\Expr\Variable('this'), $propertyName);
            return new \PhpParser\Node\Expr\MethodCall($propertyFetch, 'create', $node->args);
        });
        foreach ($this->matchedObjectTypes as $matchedObjectType) {
            $propertyName = $this->propertyNaming->fqnToVariableName($matchedObjectType) . self::FACTORY;
            $propertyType = new \Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType($matchedObjectType->getClassName() . self::FACTORY);
            $this->addConstructorDependencyToClass($node, $propertyType, $propertyName);
        }
        return $node;
    }
    public function configure(array $configuration) : void
    {
        $this->typesToServices = $configuration[self::TYPES_TO_SERVICES] ?? [];
    }
    /**
     * @return string[]
     */
    private function resolveClassesUsingTypes() : array
    {
        if ($this->classesUsingTypes !== []) {
            return $this->classesUsingTypes;
        }
        // temporary
        $classes = $this->nodeRepository->getClasses();
        if ($classes === []) {
            return [];
        }
        foreach ($classes as $class) {
            $hasTypes = (bool) $this->staticTypesInClassResolver->collectStaticCallTypeInClass($class, $this->typesToServices);
            if ($hasTypes) {
                $name = $this->getName($class);
                if ($name === null) {
                    throw new \Rector\Core\Exception\ShouldNotHappenException();
                }
                $this->classesUsingTypes[] = $name;
            }
        }
        $this->classesUsingTypes = \array_unique($this->classesUsingTypes);
        return $this->classesUsingTypes;
    }
}
