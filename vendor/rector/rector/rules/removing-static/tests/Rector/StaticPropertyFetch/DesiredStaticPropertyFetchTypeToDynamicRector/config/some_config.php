<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Core\Configuration\Option;
use Rector\RemovingStatic\Rector\StaticPropertyFetch\DesiredStaticPropertyFetchTypeToDynamicRector;
use Rector\RemovingStatic\Tests\Rector\StaticPropertyFetch\DesiredStaticPropertyFetchTypeToDynamicRector\Source\SomeStaticType;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(\Rector\Core\Configuration\Option::TYPES_TO_REMOVE_STATIC_FROM, [\Rector\RemovingStatic\Tests\Rector\StaticPropertyFetch\DesiredStaticPropertyFetchTypeToDynamicRector\Source\SomeStaticType::class]);
    $services = $containerConfigurator->services();
    $services->set(\Rector\RemovingStatic\Rector\StaticPropertyFetch\DesiredStaticPropertyFetchTypeToDynamicRector::class);
};
