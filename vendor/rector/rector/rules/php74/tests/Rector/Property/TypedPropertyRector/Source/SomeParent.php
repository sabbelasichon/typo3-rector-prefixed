<?php

declare (strict_types=1);
namespace Rector\Php74\Tests\Rector\Property\TypedPropertyRector\Source;

abstract class SomeParent
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $typedName;
}
