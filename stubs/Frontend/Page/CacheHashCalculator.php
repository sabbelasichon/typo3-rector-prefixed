<?php

declare (strict_types=1);
namespace TYPO3\CMS\Frontend\Page;

if (\class_exists(\TYPO3\CMS\Frontend\Page\CacheHashCalculator::class)) {
    return;
}
final class CacheHashCalculator
{
    public function getRelevantParameters($queryParams) : array
    {
        return [];
    }
}
