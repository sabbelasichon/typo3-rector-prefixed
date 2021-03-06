<?php

namespace Typo3RectorPrefix20210311;

use Rector\PhpSpecToPHPUnit\Rector\Class_\AddMockPropertiesRector;
use Rector\PhpSpecToPHPUnit\Rector\Class_\PhpSpecClassToPHPUnitClassRector;
use Rector\PhpSpecToPHPUnit\Rector\ClassMethod\PhpSpecMethodToPHPUnitMethodRector;
use Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecMocksToPHPUnitMocksRector;
use Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecPromisesToPHPUnitAssertRector;
use Rector\PhpSpecToPHPUnit\Rector\Variable\MockVariableToPropertyFetchRector;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(
        # 1. first convert mocks
        \Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecMocksToPHPUnitMocksRector::class
    );
    $services->set(\Rector\PhpSpecToPHPUnit\Rector\MethodCall\PhpSpecPromisesToPHPUnitAssertRector::class);
    $services->set(\Rector\PhpSpecToPHPUnit\Rector\ClassMethod\PhpSpecMethodToPHPUnitMethodRector::class);
    $services->set(\Rector\PhpSpecToPHPUnit\Rector\Class_\PhpSpecClassToPHPUnitClassRector::class);
    $services->set(\Rector\PhpSpecToPHPUnit\Rector\Class_\AddMockPropertiesRector::class);
    $services->set(\Rector\PhpSpecToPHPUnit\Rector\Variable\MockVariableToPropertyFetchRector::class);
};
