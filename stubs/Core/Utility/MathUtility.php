<?php

declare (strict_types=1);
namespace TYPO3\CMS\Core\Utility;

if (\class_exists(\TYPO3\CMS\Core\Utility\MathUtility::class)) {
    return;
}
final class MathUtility
{
    public static function canBeInterpretedAsInteger($uid) : bool
    {
        return \true;
    }
}
