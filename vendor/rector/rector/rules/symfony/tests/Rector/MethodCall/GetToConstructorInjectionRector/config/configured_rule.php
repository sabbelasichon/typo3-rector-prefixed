<?php

namespace Typo3RectorPrefix20210311;

use Rector\Core\Configuration\Option;
use Rector\Symfony\Rector\MethodCall\GetToConstructorInjectionRector;
use Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\GetTrait;
use Rector\Symfony\Tests\Rector\Source\SymfonyController;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(\Rector\Core\Configuration\Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/../xml/services.xml');
    $services = $containerConfigurator->services();
    $services->set(\Rector\Symfony\Rector\MethodCall\GetToConstructorInjectionRector::class)->call('configure', [[\Rector\Symfony\Rector\MethodCall\GetToConstructorInjectionRector::GET_METHOD_AWARE_TYPES => [\Rector\Symfony\Tests\Rector\Source\SymfonyController::class, \Rector\Symfony\Tests\Rector\MethodCall\GetToConstructorInjectionRector\Source\GetTrait::class]]]);
};
