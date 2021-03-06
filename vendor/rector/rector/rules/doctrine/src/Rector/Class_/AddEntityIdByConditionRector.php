<?php

declare (strict_types=1);
namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\NodeManipulator\ClassManipulator;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeFactory\EntityIdNodeFactory;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Rector\Doctrine\Tests\Rector\Class_\AddEntityIdByConditionRector\AddEntityIdByConditionRectorTest
 */
final class AddEntityIdByConditionRector extends \Rector\Core\Rector\AbstractRector implements \Rector\Core\Contract\Rector\ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const DETECTED_TRAITS = '$detectedTraits';
    /**
     * @var string[]
     */
    private $detectedTraits = [];
    /**
     * @var ClassManipulator
     */
    private $classManipulator;
    /**
     * @var EntityIdNodeFactory
     */
    private $entityIdNodeFactory;
    /**
     * @var ClassInsertManipulator
     */
    private $classInsertManipulator;
    public function __construct(\Rector\Core\NodeManipulator\ClassManipulator $classManipulator, \Rector\Doctrine\NodeFactory\EntityIdNodeFactory $entityIdNodeFactory, \Rector\Core\NodeManipulator\ClassInsertManipulator $classInsertManipulator)
    {
        $this->classManipulator = $classManipulator;
        $this->entityIdNodeFactory = $entityIdNodeFactory;
        $this->classInsertManipulator = $classInsertManipulator;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Add entity id with annotations when meets condition', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample(<<<'CODE_SAMPLE'
class SomeClass
{
    use SomeTrait;
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
class SomeClass
{
    use SomeTrait;

    /**
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue(strategy="AUTO")
      */
     private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
CODE_SAMPLE
, [self::DETECTED_TRAITS => ['Typo3RectorPrefix20210311\\Knp\\DoctrineBehaviors\\Model\\Translatable\\Translation', 'Typo3RectorPrefix20210311\\Knp\\DoctrineBehaviors\\Model\\Translatable\\TranslationTrait']])]);
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
        if ($this->shouldSkip($node)) {
            return null;
        }
        $idProperty = $this->entityIdNodeFactory->createIdProperty();
        $this->classInsertManipulator->addAsFirstMethod($node, $idProperty);
        return $node;
    }
    public function configure(array $configuration) : void
    {
        $this->detectedTraits = $configuration[self::DETECTED_TRAITS] ?? [];
    }
    private function shouldSkip(\PhpParser\Node\Stmt\Class_ $class) : bool
    {
        if ($this->classNodeAnalyzer->isAnonymousClass($class)) {
            return \true;
        }
        if (!$this->isTraitMatch($class)) {
            return \true;
        }
        return (bool) $class->getProperty('id');
    }
    private function isTraitMatch(\PhpParser\Node\Stmt\Class_ $class) : bool
    {
        $usedTraits = $this->classManipulator->getUsedTraits($class);
        foreach (\array_keys($usedTraits) as $traitName) {
            foreach ($this->detectedTraits as $detectedTrait) {
                if ($traitName === $detectedTrait) {
                    return \true;
                }
            }
        }
        return \false;
    }
}
