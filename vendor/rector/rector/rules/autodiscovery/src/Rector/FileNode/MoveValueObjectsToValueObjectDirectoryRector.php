<?php

declare (strict_types=1);
namespace Rector\Autodiscovery\Rector\FileNode;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Autodiscovery\Analyzer\ClassAnalyzer;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\PhpParser\Node\CustomNode\FileNode;
use Rector\Core\Rector\AbstractRector;
use Rector\FileSystemRector\ValueObject\MovedFileWithNodes;
use Rector\FileSystemRector\ValueObjectFactory\MovedFileWithNodesFactory;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * Inspiration @see https://github.com/rectorphp/rector/pull/1865/files#diff-0d18e660cdb626958662641b491623f8
 * @wip
 *
 * @sponsor Thanks https://spaceflow.io/ for sponsoring this rule - visit them on https://github.com/SpaceFlow-app
 *
 * @see \Rector\Autodiscovery\Tests\Rector\FileNode\MoveValueObjectsToValueObjectDirectoryRector\MoveValueObjectsToValueObjectDirectoryRectorTest
 */
final class MoveValueObjectsToValueObjectDirectoryRector extends \Rector\Core\Rector\AbstractRector implements \Rector\Core\Contract\Rector\ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const TYPES = 'types';
    /**
     * @var string
     */
    public const SUFFIXES = 'suffixes';
    /**
     * @api
     * @var string
     */
    public const ENABLE_VALUE_OBJECT_GUESSING = '$enableValueObjectGuessing';
    /**
     * @var string[]
     */
    private const COMMON_SERVICE_SUFFIXES = ['Repository', 'Command', 'Mapper', 'Controller', 'Presenter', 'Factory', 'Test', 'TestCase', 'Service'];
    /**
     * @var bool
     */
    private $enableValueObjectGuessing = \true;
    /**
     * @var string[]
     */
    private $types = [];
    /**
     * @var string[]
     */
    private $suffixes = [];
    /**
     * @var ClassAnalyzer
     */
    private $classAnalyzer;
    /**
     * @var MovedFileWithNodesFactory
     */
    private $movedFileWithNodesFactory;
    public function __construct(\Rector\Autodiscovery\Analyzer\ClassAnalyzer $classAnalyzer, \Rector\FileSystemRector\ValueObjectFactory\MovedFileWithNodesFactory $movedFileWithNodesFactory)
    {
        $this->classAnalyzer = $classAnalyzer;
        $this->movedFileWithNodesFactory = $movedFileWithNodesFactory;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Move value object to ValueObject namespace/directory', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample(<<<'CODE_SAMPLE'
// app/Exception/Name.php
class Name
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
// app/ValueObject/Name.php
class Name
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
CODE_SAMPLE
, [self::TYPES => ['ValueObjectInterfaceClassName'], self::SUFFIXES => ['Search'], self::ENABLE_VALUE_OBJECT_GUESSING => \true])]);
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\Rector\Core\PhpParser\Node\CustomNode\FileNode::class];
    }
    /**
     * @param FileNode $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $class = $this->betterNodeFinder->findFirstInstanceOf([$node], \PhpParser\Node\Stmt\Class_::class);
        if (!$class instanceof \PhpParser\Node\Stmt\Class_) {
            return null;
        }
        if (!$this->isValueObjectMatch($class)) {
            return null;
        }
        $smartFileInfo = $node->getFileInfo();
        $movedFileWithNodes = $this->movedFileWithNodesFactory->createWithDesiredGroup($smartFileInfo, $node->stmts, 'ValueObject');
        if (!$movedFileWithNodes instanceof \Rector\FileSystemRector\ValueObject\MovedFileWithNodes) {
            return null;
        }
        $this->removedAndAddedFilesCollector->addMovedFile($movedFileWithNodes);
        return null;
    }
    public function configure(array $configuration) : void
    {
        $this->types = $configuration[self::TYPES] ?? [];
        $this->suffixes = $configuration[self::SUFFIXES] ?? [];
        $this->enableValueObjectGuessing = $configuration[self::ENABLE_VALUE_OBJECT_GUESSING] ?? \false;
    }
    private function isValueObjectMatch(\PhpParser\Node\Stmt\Class_ $class) : bool
    {
        if ($this->isSuffixMatch($class)) {
            return \true;
        }
        $className = $this->getName($class);
        if ($className === null) {
            return \false;
        }
        foreach ($this->types as $type) {
            if (\is_a($className, $type, \true)) {
                return \true;
            }
        }
        if ($this->isKnownServiceType($className)) {
            return \false;
        }
        if (!$this->enableValueObjectGuessing) {
            return \false;
        }
        return $this->classAnalyzer->isValueObjectClass($class);
    }
    private function isSuffixMatch(\PhpParser\Node\Stmt\Class_ $class) : bool
    {
        $className = $class->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::CLASS_NAME);
        if ($className !== null) {
            foreach ($this->suffixes as $suffix) {
                if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::endsWith($className, $suffix)) {
                    return \true;
                }
            }
        }
        return \false;
    }
    private function isKnownServiceType(string $className) : bool
    {
        foreach (self::COMMON_SERVICE_SUFFIXES as $commonServiceSuffix) {
            if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::endsWith($className, $commonServiceSuffix)) {
                return \true;
            }
        }
        return \false;
    }
}
