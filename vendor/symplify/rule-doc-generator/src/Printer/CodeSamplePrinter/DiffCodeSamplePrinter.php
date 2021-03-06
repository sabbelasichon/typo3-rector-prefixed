<?php

declare (strict_types=1);
namespace Symplify\RuleDocGenerator\Printer\CodeSamplePrinter;

use Typo3RectorPrefix20210311\Symplify\MarkdownDiff\Differ\MarkdownDiffer;
use Symplify\RuleDocGenerator\Contract\CodeSampleInterface;
final class DiffCodeSamplePrinter
{
    /**
     * @var MarkdownDiffer
     */
    private $markdownDiffer;
    public function __construct(\Typo3RectorPrefix20210311\Symplify\MarkdownDiff\Differ\MarkdownDiffer $markdownDiffer)
    {
        $this->markdownDiffer = $markdownDiffer;
    }
    /**
     * @return string[]
     */
    public function print(\Symplify\RuleDocGenerator\Contract\CodeSampleInterface $codeSample) : array
    {
        $lines = [];
        $lines[] = $this->markdownDiffer->diff($codeSample->getBadCode(), $codeSample->getGoodCode());
        return $lines;
    }
}
