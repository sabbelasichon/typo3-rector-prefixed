<?php

declare (strict_types=1);
namespace Rector\Autodiscovery\Tests\Rector\FileNode\MoveInterfacesToContractNamespaceDirectoryRector\Source\Control;

interface FormFactory
{
    /**
     * @return SomeForm
     */
    public function create();
}
