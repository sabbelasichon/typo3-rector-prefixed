<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\Helper\Database\Refactorings;

use PhpParser\Node\Expr\MethodCall;
interface DatabaseConnectionToDbalRefactoring
{
    public function refactor(\PhpParser\Node\Expr\MethodCall $oldNode) : array;
    public function canHandle(string $methodName) : bool;
}
