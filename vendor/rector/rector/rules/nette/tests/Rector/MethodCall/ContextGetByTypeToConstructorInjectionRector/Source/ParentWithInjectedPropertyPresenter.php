<?php

declare (strict_types=1);
namespace Rector\Nette\Tests\Rector\MethodCall\ContextGetByTypeToConstructorInjectionRector\Source;

use Typo3RectorPrefix20210311\Nette\Application\IPresenter;
use Typo3RectorPrefix20210311\Nette\Application\IResponse;
use Typo3RectorPrefix20210311\Nette\Application\Request;
class ParentWithInjectedPropertyPresenter implements \Typo3RectorPrefix20210311\Nette\Application\IPresenter
{
    /**
     * @inject
     * @var SomeTypeToInject
     */
    public $someTypeToInject;
    function run(\Typo3RectorPrefix20210311\Nette\Application\Request $request) : \Typo3RectorPrefix20210311\Nette\Application\IResponse
    {
    }
}
