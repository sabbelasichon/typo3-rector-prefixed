<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\RemovingStatic\Rector\Class_\NewUniqueObjectToEntityFactoryRector;
use Rector\RemovingStatic\Rector\Class_\PassFactoryToUniqueObjectRector;
use Rector\RemovingStatic\Tests\Rector\Class_\PassFactoryToEntityRector\Source\TurnMeToService;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $typesToServices = [\Rector\RemovingStatic\Tests\Rector\Class_\PassFactoryToEntityRector\Source\TurnMeToService::class];
    $services->set(\Rector\RemovingStatic\Rector\Class_\PassFactoryToUniqueObjectRector::class)->call('configure', [[\Rector\RemovingStatic\Rector\Class_\PassFactoryToUniqueObjectRector::TYPES_TO_SERVICES => $typesToServices]]);
    $services->set(\Rector\RemovingStatic\Rector\Class_\NewUniqueObjectToEntityFactoryRector::class)->call('configure', [[\Rector\RemovingStatic\Rector\Class_\NewUniqueObjectToEntityFactoryRector::TYPES_TO_SERVICES => $typesToServices]]);
};
