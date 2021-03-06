<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Core\Configuration\Option;
use Rector\SymfonyCodeQuality\Rector\Class_\EventListenerToEventSubscriberRector;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    // wtf: all test have to be in single file due to autoloading race-condigition and container creating issue of fixture
    $parameters->set(\Rector\Core\Configuration\Option::SYMFONY_CONTAINER_XML_PATH_PARAMETER, __DIR__ . '/listener_services.xml');
    $services = $containerConfigurator->services();
    $services->set(\Rector\SymfonyCodeQuality\Rector\Class_\EventListenerToEventSubscriberRector::class);
};
