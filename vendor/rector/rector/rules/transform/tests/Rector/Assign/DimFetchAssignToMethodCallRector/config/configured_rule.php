<?php

namespace Typo3RectorPrefix20210311;

use Rector\Transform\Rector\Assign\DimFetchAssignToMethodCallRector;
use Rector\Transform\ValueObject\DimFetchAssignToMethodCall;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Transform\Rector\Assign\DimFetchAssignToMethodCallRector::class)->call('configure', [[\Rector\Transform\Rector\Assign\DimFetchAssignToMethodCallRector::DIM_FETCH_ASSIGN_TO_METHOD_CALL => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Transform\ValueObject\DimFetchAssignToMethodCall('Typo3RectorPrefix20210311\\Nette\\Application\\Routers\\RouteList', 'Typo3RectorPrefix20210311\\Nette\\Application\\Routers\\Route', 'addRoute')])]]);
};
