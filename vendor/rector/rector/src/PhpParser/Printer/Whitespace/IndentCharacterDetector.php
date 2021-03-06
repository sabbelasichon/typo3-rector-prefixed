<?php

declare (strict_types=1);
namespace Rector\Core\PhpParser\Printer\Whitespace;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Stmt;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo;
final class IndentCharacterDetector
{
    /**
     * @var string
     * @see https://regex101.com/r/w5E8Rh/1
     */
    private const FOUR_SPACE_START_REGEX = '#^ {4}#m';
    /**
     * Solves https://github.com/rectorphp/rector/issues/1964
     *
     * Some files have spaces, some have tabs. Keep the original indent if possible.
     *
     * @param Stmt[] $stmts
     */
    public function detect(array $stmts) : string
    {
        foreach ($stmts as $stmt) {
            if (!$stmt instanceof \PhpParser\Node) {
                continue;
            }
            $fileInfo = $stmt->getAttribute(\Rector\NodeTypeResolver\Node\AttributeKey::FILE_INFO);
            if (!$fileInfo instanceof \Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileInfo) {
                continue;
            }
            $whitespaces = \count(\Typo3RectorPrefix20210311\Nette\Utils\Strings::matchAll($fileInfo->getContents(), self::FOUR_SPACE_START_REGEX));
            $tabs = \count(\Typo3RectorPrefix20210311\Nette\Utils\Strings::matchAll($fileInfo->getContents(), '#^\\t#m'));
            // tab vs space
            return ($whitespaces <=> $tabs) >= 0 ? ' ' : "\t";
        }
        // use space by default
        return ' ';
    }
}
