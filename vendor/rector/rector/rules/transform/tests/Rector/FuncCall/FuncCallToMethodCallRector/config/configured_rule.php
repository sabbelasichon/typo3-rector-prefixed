<?php

namespace Typo3RectorPrefix20210311;

use Rector\Transform\Rector\FuncCall\FuncCallToMethodCallRector;
use Rector\Transform\Tests\Rector\FuncCall\FuncCallToMethodCallRector\Source\SomeTranslator;
use Rector\Transform\ValueObject\FuncCallToMethodCall;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Transform\Rector\FuncCall\FuncCallToMethodCallRector::class)->call('configure', [[\Rector\Transform\Rector\FuncCall\FuncCallToMethodCallRector::FUNC_CALL_TO_CLASS_METHOD_CALL => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Transform\ValueObject\FuncCallToMethodCall('view', 'Typo3RectorPrefix20210311\\Namespaced\\SomeRenderer', 'render'), new \Rector\Transform\ValueObject\FuncCallToMethodCall('translate', \Rector\Transform\Tests\Rector\FuncCall\FuncCallToMethodCallRector\Source\SomeTranslator::class, 'translateMethod'), new \Rector\Transform\ValueObject\FuncCallToMethodCall('Rector\\Transform\\Tests\\Rector\\Function_\\FuncCallToMethodCallRector\\Source\\some_view_function', 'Typo3RectorPrefix20210311\\Namespaced\\SomeRenderer', 'render')])]]);
};
