<?php

namespace Typo3RectorPrefix20210311;

use Rector\Removing\Rector\Class_\RemoveTraitRector;
use Rector\Removing\Tests\Rector\Class_\RemoveTraitRector\Source\TraitToBeRemoved;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Removing\Rector\Class_\RemoveTraitRector::class)->call('configure', [[\Rector\Removing\Rector\Class_\RemoveTraitRector::TRAITS_TO_REMOVE => [\Rector\Removing\Tests\Rector\Class_\RemoveTraitRector\Source\TraitToBeRemoved::class]]]);
};
