<?php

namespace TYPO3\TestingFramework\Core;

if (\interface_exists(\TYPO3\TestingFramework\Core\AccessibleObjectInterface::class)) {
    return;
}
interface AccessibleObjectInterface
{
}
