<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\PhpDocNodeFactory;

use Doctrine\ORM\Mapping\Annotation;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use PhpParser\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use Rector\BetterPhpDocParser\Contract\Doctrine\DoctrineRelationTagValueNodeInterface;
use Rector\BetterPhpDocParser\Contract\PhpDocNodeFactoryInterface;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EmbeddableTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EmbeddedTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EntityTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\InheritanceTypeTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ColumnTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\CustomIdGeneratorTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\GeneratedValueTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\IdTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\JoinColumnTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ManyToManyTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ManyToOneTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\OneToManyTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\OneToOneTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\BlameableTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\LocaleTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\LoggableTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\SlugTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\SoftDeleteableTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TranslatableTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeLeftTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeLevelTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeParentTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeRightTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeRootTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\VersionedTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\JMSInjectParamsTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\JMSServiceValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\SerializerTypeTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\PHPDI\PHPDIInjectTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioMethodTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioRouteTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioTemplateTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\SymfonyRouteTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertChoiceTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertEmailTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertRangeTagValueNode;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertTypeTagValueNode;
final class MultiPhpDocNodeFactory extends \Rector\BetterPhpDocParser\PhpDocNodeFactory\AbstractPhpDocNodeFactory implements \Rector\BetterPhpDocParser\Contract\PhpDocNodeFactoryInterface
{
    /**
     * @var ArrayPartPhpDocTagPrinter
     */
    private $arrayPartPhpDocTagPrinter;
    /**
     * @var TagValueNodePrinter
     */
    private $tagValueNodePrinter;
    public function __construct(\Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter, \Rector\BetterPhpDocParser\Printer\TagValueNodePrinter $tagValueNodePrinter)
    {
        $this->arrayPartPhpDocTagPrinter = $arrayPartPhpDocTagPrinter;
        $this->tagValueNodePrinter = $tagValueNodePrinter;
    }
    /**
     * @return array<class-string<AbstractTagValueNode>, class-string<Annotation>>
     */
    public function getTagValueNodeClassesToAnnotationClasses() : array
    {
        return [
            // tag value node class => annotation class
            // doctrine - intentionally in string, so prefixer of rector.phar doesn't prefix it
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EmbeddableTagValueNode::class => 'Doctrine\\ORM\\Mapping\\Embeddable',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EntityTagValueNode::class => 'Doctrine\\ORM\\Mapping\\Entity',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\InheritanceTypeTagValueNode::class => 'Doctrine\\ORM\\Mapping\\InheritanceType',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ColumnTagValueNode::class => 'Doctrine\\ORM\\Mapping\\Column',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\CustomIdGeneratorTagValueNode::class => 'Doctrine\\ORM\\Mapping\\CustomIdGenerator',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\IdTagValueNode::class => 'Doctrine\\ORM\\Mapping\\Id',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\GeneratedValueTagValueNode::class => 'Doctrine\\ORM\\Mapping\\GeneratedValue',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\JoinColumnTagValueNode::class => 'Doctrine\\ORM\\Mapping\\JoinColumn',
            // symfony/http-kernel
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\SymfonyRouteTagValueNode::class => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Routing\\Annotation\\Route',
            // symfony/validator
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertRangeTagValueNode::class => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Validator\\Constraints\\Range',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertTypeTagValueNode::class => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Validator\\Constraints\\Type',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertChoiceTagValueNode::class => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Validator\\Constraints\\Choice',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Symfony\Validator\Constraints\AssertEmailTagValueNode::class => 'Typo3RectorPrefix20210311\\Symfony\\Component\\Validator\\Constraints\\Email',
            // gedmo
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\LocaleTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Locale',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\BlameableTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Blameable',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\SlugTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Slug',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\SoftDeleteableTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\SoftDeleteable',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeRootTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\TreeRoot',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeLeftTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\TreeLeft',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeLevelTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\TreeLevel',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeParentTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\TreeParent',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeRightTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\TreeRight',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\VersionedTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Versioned',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TranslatableTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Translatable',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\LoggableTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Loggable',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Gedmo\TreeTagValueNode::class => 'Typo3RectorPrefix20210311\\Gedmo\\Mapping\\Annotation\\Tree',
            // Sensio
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioTemplateTagValueNode::class => 'Typo3RectorPrefix20210311\\Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Template',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioMethodTagValueNode::class => 'Typo3RectorPrefix20210311\\Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Method',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Sensio\SensioRouteTagValueNode::class => 'Typo3RectorPrefix20210311\\Sensio\\Bundle\\FrameworkExtraBundle\\Configuration\\Route',
            // JMS
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\JMSInjectParamsTagValueNode::class => 'Typo3RectorPrefix20210311\\JMS\\DiExtraBundle\\Annotation\\InjectParams',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\JMSServiceValueNode::class => 'Typo3RectorPrefix20210311\\JMS\\DiExtraBundle\\Annotation\\Service',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\JMS\SerializerTypeTagValueNode::class => 'Typo3RectorPrefix20210311\\JMS\\Serializer\\Annotation\\Type',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\PHPDI\PHPDIInjectTagValueNode::class => 'Typo3RectorPrefix20210311\\DI\\Annotation\\Inject',
            // Doctrine
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\OneToOneTagValueNode::class => 'Doctrine\\ORM\\Mapping\\OneToOne',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\OneToManyTagValueNode::class => 'Doctrine\\ORM\\Mapping\\OneToMany',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ManyToManyTagValueNode::class => 'Doctrine\\ORM\\Mapping\\ManyToMany',
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Property_\ManyToOneTagValueNode::class => 'Doctrine\\ORM\\Mapping\\ManyToOne',
            // @todo cover with reflection / services to avoid forgetting registering it?
            \Rector\BetterPhpDocParser\ValueObject\PhpDocNode\Doctrine\Class_\EmbeddedTagValueNode::class => 'Doctrine\\ORM\\Mapping\\Embedded',
        ];
    }
    public function createFromNodeAndTokens(\PhpParser\Node $node, \PHPStan\PhpDocParser\Parser\TokenIterator $tokenIterator, string $annotationClass) : ?\PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode
    {
        $annotation = $this->nodeAnnotationReader->readAnnotation($node, $annotationClass);
        if ($annotation === null) {
            return null;
        }
        $tagValueNodeClassesToAnnotationClasses = $this->getTagValueNodeClassesToAnnotationClasses();
        $tagValueNodeClass = \array_search($annotationClass, $tagValueNodeClassesToAnnotationClasses, \true);
        if ($tagValueNodeClass === \false) {
            return null;
        }
        $items = $this->annotationItemsResolver->resolve($annotation);
        $content = $this->annotationContentResolver->resolveFromTokenIterator($tokenIterator);
        if (\is_a($tagValueNodeClass, \Rector\BetterPhpDocParser\Contract\Doctrine\DoctrineRelationTagValueNodeInterface::class, \true)) {
            /** @var ManyToOne|OneToMany|ManyToMany|OneToOne|Embedded $annotation */
            $fullyQualifiedTargetEntity = $this->resolveEntityClass($annotation, $node);
            return new $tagValueNodeClass($this->arrayPartPhpDocTagPrinter, $this->tagValueNodePrinter, $items, $content, $fullyQualifiedTargetEntity);
        }
        return new $tagValueNodeClass($this->arrayPartPhpDocTagPrinter, $this->tagValueNodePrinter, $items, $content);
    }
    /**
     * @param ManyToOne|OneToMany|ManyToMany|OneToOne|Embedded $annotation
     */
    private function resolveEntityClass(object $annotation, \PhpParser\Node $node) : string
    {
        if ($annotation instanceof \Doctrine\ORM\Mapping\Embedded) {
            return $this->resolveFqnTargetEntity($annotation->class, $node);
        }
        return $this->resolveFqnTargetEntity($annotation->targetEntity, $node);
    }
}
