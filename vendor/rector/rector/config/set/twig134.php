<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223;

use Rector\Symfony\Rector\Return_\SimpleFunctionAndFilterRector;
use Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Symfony\Rector\Return_\SimpleFunctionAndFilterRector::class);
};