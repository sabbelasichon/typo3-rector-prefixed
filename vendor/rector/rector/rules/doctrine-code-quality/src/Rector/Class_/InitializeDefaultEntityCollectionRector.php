<?php

declare (strict_types=1);
namespace Rector\DoctrineCodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Expression;
use Rector\BetterPhpDocParser\Contract\Doctrine\ToManyTagNodeInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EntityTagValueNode;
use Rector\Core\NodeManipulator\ClassDependencyManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/best-practices.html#initialize-collections-in-the-constructor
 *
 * @see \Rector\DoctrineCodeQuality\Tests\Rector\Class_\InitializeDefaultEntityCollectionRector\InitializeDefaultEntityCollectionRectorTest
 */
final class InitializeDefaultEntityCollectionRector extends \Rector\Core\Rector\AbstractRector
{
    /**
     * @var ClassDependencyManipulator
     */
    private $classDependencyManipulator;
    public function __construct(\Rector\Core\NodeManipulator\ClassDependencyManipulator $classDependencyManipulator)
    {
        $this->classDependencyManipulator = $classDependencyManipulator;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Initialize collection property in Entity constructor', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity="MarketingEvent")
     */
    private $marketingEvents = [];
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity="MarketingEvent")
     */
    private $marketingEvents = [];

    public function __construct()
    {
        $this->marketingEvents = new ArrayCollection();
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
        return [\PhpParser\Node\Stmt\Class_::class];
    }
    /**
     * @param Class_ $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        if (!$phpDocInfo->hasByType(\Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EntityTagValueNode::class)) {
            return null;
        }
        $toManyPropertyNames = $this->resolveToManyPropertyNames($node);
        if ($toManyPropertyNames === []) {
            return null;
        }
        $assigns = $this->createAssignsOfArrayCollectionsForPropertyNames($toManyPropertyNames);
        $this->classDependencyManipulator->addStmtsToConstructorIfNotThereYet($node, $assigns);
        return $node;
    }
    /**
     * @return string[]
     */
    private function resolveToManyPropertyNames(\PhpParser\Node\Stmt\Class_ $class) : array
    {
        $collectionPropertyNames = [];
        foreach ($class->getProperties() as $property) {
            if (\count($property->props) !== 1) {
                continue;
            }
            $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
            if (!$phpDocInfo->hasByType(\Rector\BetterPhpDocParser\Contract\Doctrine\ToManyTagNodeInterface::class)) {
                continue;
            }
            $collectionPropertyNames[] = $this->getName($property);
        }
        return $collectionPropertyNames;
    }
    /**
     * @param string[] $propertyNames
     * @return Expression[]
     */
    private function createAssignsOfArrayCollectionsForPropertyNames(array $propertyNames) : array
    {
        $assigns = [];
        foreach ($propertyNames as $propertyName) {
            $assigns[] = $this->createPropertyArrayCollectionAssign($propertyName);
        }
        return $assigns;
    }
    private function createPropertyArrayCollectionAssign(string $toManyPropertyName) : \PhpParser\Node\Stmt\Expression
    {
        $propertyFetch = $this->nodeFactory->createPropertyFetch('this', $toManyPropertyName);
        $new = new \PhpParser\Node\Expr\New_(new \PhpParser\Node\Name\FullyQualified('Typo3RectorPrefix20210311\\Doctrine\\Common\\Collections\\ArrayCollection'));
        $assign = new \PhpParser\Node\Expr\Assign($propertyFetch, $new);
        return new \PhpParser\Node\Stmt\Expression($assign);
    }
}
