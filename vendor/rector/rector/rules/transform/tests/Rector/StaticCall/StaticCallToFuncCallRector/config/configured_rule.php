<?php

namespace Typo3RectorPrefix20210311;

use Rector\Transform\Rector\StaticCall\StaticCallToFuncCallRector;
use Rector\Transform\Tests\Rector\StaticCall\StaticCallToFuncCallRector\Source\SomeOldStaticClass;
use Rector\Transform\ValueObject\StaticCallToFuncCall;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Transform\Rector\StaticCall\StaticCallToFuncCallRector::class)->call('configure', [[\Rector\Transform\Rector\StaticCall\StaticCallToFuncCallRector::STATIC_CALLS_TO_FUNCTIONS => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Transform\ValueObject\StaticCallToFuncCall(\Rector\Transform\Tests\Rector\StaticCall\StaticCallToFuncCallRector\Source\SomeOldStaticClass::class, 'render', 'view')])]]);
};
