<?php

declare (strict_types=1);
namespace Rector\Autodiscovery\Rector\FileNode;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use PhpParser\Node;
use Rector\Autodiscovery\FileLocation\ExpectedFileLocationResolver;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\PhpParser\Node\CustomNode\FileNode;
use Rector\Core\Rector\AbstractRector;
use Rector\FileSystemRector\ValueObject\MovedFileWithNodes;
use Rector\FileSystemRector\ValueObjectFactory\MovedFileWithNodesFactory;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
use Typo3RectorPrefix20210311\Webmozart\Assert\Assert;
/**
 * @sponsor Thanks https://spaceflow.io/ for sponsoring this rule - visit them on https://github.com/SpaceFlow-app
 *
 * Inspiration @see https://github.com/rectorphp/rector/pull/1865/files#diff-0d18e660cdb626958662641b491623f8
 *
 * @see \Rector\Autodiscovery\Tests\Rector\FileNode\MoveServicesBySuffixToDirectoryRector\MoveServicesBySuffixToDirectoryRectorTest
 * @see \Rector\Autodiscovery\Tests\Rector\FileNode\MoveServicesBySuffixToDirectoryRector\MutualRenameTest
 */
final class MoveServicesBySuffixToDirectoryRector extends \Rector\Core\Rector\AbstractRector implements \Rector\Core\Contract\Rector\ConfigurableRectorInterface
{
    /**
     * @var string
     */
    public const GROUP_NAMES_BY_SUFFIX = 'group_names_by_suffix';
    /**
     * @var string[]
     */
    private $groupNamesBySuffix = [];
    /**
     * @var ExpectedFileLocationResolver
     */
    private $expectedFileLocationResolver;
    /**
     * @var MovedFileWithNodesFactory
     */
    private $movedFileWithNodesFactory;
    public function __construct(\Rector\Autodiscovery\FileLocation\ExpectedFileLocationResolver $expectedFileLocationResolver, \Rector\FileSystemRector\ValueObjectFactory\MovedFileWithNodesFactory $movedFileWithNodesFactory)
    {
        $this->expectedFileLocationResolver = $expectedFileLocationResolver;
        $this->movedFileWithNodesFactory = $movedFileWithNodesFactory;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Move classes by their suffix to their own group/directory', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample(<<<'CODE_SAMPLE'
// file: app/Entity/ProductRepository.php

namespace App/Entity;

class ProductRepository
{
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
// file: app/Repository/ProductRepository.php

namespace App/Repository;

class ProductRepository
{
}
CODE_SAMPLE
, [self::GROUP_NAMES_BY_SUFFIX => ['Repository']])]);
    }
    /**
     * @param FileNode $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $classLikes = $this->betterNodeFinder->findClassLikes($node);
        if ($classLikes === []) {
            return null;
        }
        $this->processGroupNamesBySuffix($node->getFileInfo(), $node, $this->groupNamesBySuffix);
        return null;
    }
    public function configure(array $configuration) : void
    {
        $groupNamesBySuffix = $configuration[self::GROUP_NAMES_BY_SUFFIX] ?? [];
        \Typo3RectorPrefix20210311\Webmozart\Assert\Assert::allString($groupNamesBySuffix);
        $this->groupNamesBySuffix = $groupNamesBySuffix;
    }
    /**
     * @return string[]
     */
    public function getNodeTypes() : array
    {
        return [\Rector\Core\PhpParser\Node\CustomNode\FileNode::class];
    }
    /**
     * A. Match classes by suffix and move them to group namespace
     *
     * E.g. "App\Controller\SomeException"
     * ↓
     * "App\Exception\SomeException"
     *
     * @param string[] $groupNamesBySuffix
     */
    private function processGroupNamesBySuffix(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo, \Rector\Core\PhpParser\Node\CustomNode\FileNode $fileNode, array $groupNamesBySuffix) : void
    {
        foreach ($groupNamesBySuffix as $groupName) {
            // has class suffix
            $suffixPattern = '\\w+' . $groupName . '(Test)?\\.php$';
            if (!\Typo3RectorPrefix20210311\Nette\Utils\Strings::match($smartFileInfo->getRealPath(), '#' . $suffixPattern . '#')) {
                continue;
            }
            if ($this->isLocatedInExpectedLocation($groupName, $suffixPattern, $smartFileInfo)) {
                continue;
            }
            // file is already in the group
            if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::match($smartFileInfo->getPath(), '#' . $groupName . '$#')) {
                continue;
            }
            $this->moveFileToGroupName($smartFileInfo, $fileNode, $groupName);
            return;
        }
    }
    private function isLocatedInExpectedLocation(string $groupName, string $suffixPattern, \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : bool
    {
        $expectedLocationFilePattern = $this->expectedFileLocationResolver->resolve($groupName, $suffixPattern);
        return (bool) \Typo3RectorPrefix20210311\Nette\Utils\Strings::match($smartFileInfo->getRealPath(), $expectedLocationFilePattern);
    }
    private function moveFileToGroupName(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $fileInfo, \Rector\Core\PhpParser\Node\CustomNode\FileNode $fileNode, string $desiredGroupName) : void
    {
        $movedFileWithNodes = $this->movedFileWithNodesFactory->createWithDesiredGroup($fileInfo, $fileNode->stmts, $desiredGroupName);
        if (!$movedFileWithNodes instanceof \Rector\FileSystemRector\ValueObject\MovedFileWithNodes) {
            return;
        }
        $this->removedAndAddedFilesCollector->addMovedFile($movedFileWithNodes);
    }
}
