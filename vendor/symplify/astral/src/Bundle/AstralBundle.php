<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311\Symplify\Astral\Bundle;

use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\ContainerBuilder;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Typo3RectorPrefix20210311\Symfony\Component\HttpKernel\Bundle\Bundle;
use Typo3RectorPrefix20210311\Symplify\Astral\DependencyInjection\Extension\AstralExtension;
use Typo3RectorPrefix20210311\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass;
final class AstralBundle extends \Typo3RectorPrefix20210311\Symfony\Component\HttpKernel\Bundle\Bundle
{
    public function build(\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $containerBuilder->addCompilerPass(new \Typo3RectorPrefix20210311\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass());
    }
    protected function createContainerExtension() : ?\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        return new \Typo3RectorPrefix20210311\Symplify\Astral\DependencyInjection\Extension\AstralExtension();
    }
}
