<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Arguments\Rector\ClassMethod\ArgumentDefaultValueReplacerRector;
use Rector\Arguments\ValueObject\ArgumentDefaultValueReplacer;
use Rector\Symfony2\Rector\StaticCall\ParseFileRector;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Symfony2\Rector\StaticCall\ParseFileRector::class);
    $services->set(\Rector\Arguments\Rector\ClassMethod\ArgumentDefaultValueReplacerRector::class)->call('configure', [[\Rector\Arguments\Rector\ClassMethod\ArgumentDefaultValueReplacerRector::REPLACED_ARGUMENTS => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([
        // https://github.com/symfony/symfony/commit/912fc4de8fd6de1e5397be4a94d39091423e5188
        new \Rector\Arguments\ValueObject\ArgumentDefaultValueReplacer('Typo3RectorPrefix20210311\\Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface', 'generate', 2, \true, 'Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface::ABSOLUTE_URL'),
        new \Rector\Arguments\ValueObject\ArgumentDefaultValueReplacer('Typo3RectorPrefix20210311\\Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface', 'generate', 2, \false, 'Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface::ABSOLUTE_PATH'),
        new \Rector\Arguments\ValueObject\ArgumentDefaultValueReplacer('Typo3RectorPrefix20210311\\Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface', 'generate', 2, 'relative', 'Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface::RELATIVE_PATH'),
        new \Rector\Arguments\ValueObject\ArgumentDefaultValueReplacer('Typo3RectorPrefix20210311\\Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface', 'generate', 2, 'network', 'Symfony\\Component\\Routing\\Generator\\UrlGeneratorInterface::NETWORK_PATH'),
    ])]]);
};
