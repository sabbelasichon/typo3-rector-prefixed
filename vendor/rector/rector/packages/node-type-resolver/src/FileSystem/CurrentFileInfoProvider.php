<?php

declare (strict_types=1);
namespace Rector\NodeTypeResolver\FileSystem;

use PhpParser\Node;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class CurrentFileInfoProvider
{
    /**
     * @var Node[]
     */
    private $currentStmts = [];
    /**
     * @var SmartFileInfo|null
     */
    private $smartFileInfo;
    public function setCurrentFileInfo(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo $smartFileInfo) : void
    {
        $this->smartFileInfo = $smartFileInfo;
    }
    public function getSmartFileInfo() : ?\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo
    {
        return $this->smartFileInfo;
    }
    /**
     * @param Node[] $stmts
     */
    public function setCurrentStmts(array $stmts) : void
    {
        $this->currentStmts = $stmts;
    }
    /**
     * @return Node[]
     */
    public function getCurrentStmts() : array
    {
        return $this->currentStmts;
    }
}
