<?php

namespace Typo3RectorPrefix20210311;

use Rector\Transform\Rector\New_\NewToConstructorInjectionRector;
use Rector\Transform\Tests\Rector\New_\NewToConstructorInjectionRector\Source\DummyValidator;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Transform\Rector\New_\NewToConstructorInjectionRector::class)->call('configure', [[\Rector\Transform\Rector\New_\NewToConstructorInjectionRector::TYPES_TO_CONSTRUCTOR_INJECTION => [\Rector\Transform\Tests\Rector\New_\NewToConstructorInjectionRector\Source\DummyValidator::class]]]);
};
