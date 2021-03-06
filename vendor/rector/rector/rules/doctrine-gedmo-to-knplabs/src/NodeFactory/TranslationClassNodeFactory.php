<?php

declare (strict_types=1);
namespace Rector\DoctrineGedmoToKnplabs\NodeFactory;

use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\ValueObjectFactory\PhpDocNode\Doctrine\EntityTagValueNodeFactory;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
final class TranslationClassNodeFactory
{
    /**
     * @var PhpDocInfoFactory
     */
    private $phpDocInfoFactory;
    /**
     * @var ClassInsertManipulator
     */
    private $classInsertManipulator;
    /**
     * @var EntityTagValueNodeFactory
     */
    private $entityTagValueNodeFactory;
    public function __construct(\Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory $phpDocInfoFactory, \Rector\Core\NodeManipulator\ClassInsertManipulator $classInsertManipulator, \Rector\BetterPhpDocParser\ValueObjectFactory\PhpDocNode\Doctrine\EntityTagValueNodeFactory $entityTagValueNodeFactory)
    {
        $this->phpDocInfoFactory = $phpDocInfoFactory;
        $this->classInsertManipulator = $classInsertManipulator;
        $this->entityTagValueNodeFactory = $entityTagValueNodeFactory;
    }
    public function create(string $classShortName) : \PhpParser\Node\Stmt\Class_
    {
        $class = new \PhpParser\Node\Stmt\Class_($classShortName);
        $class->implements[] = new \PhpParser\Node\Name\FullyQualified('Typo3RectorPrefix20210311\\Knp\\DoctrineBehaviors\\Contract\\Entity\\TranslationInterface');
        $this->classInsertManipulator->addAsFirstTrait($class, 'Typo3RectorPrefix20210311\\Knp\\DoctrineBehaviors\\Model\\Translatable\\TranslationTrait');
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);
        $entityTagValueNode = $this->entityTagValueNodeFactory->create();
        $phpDocInfo->addTagValueNodeWithShortName($entityTagValueNode);
        return $class;
    }
}
