<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Transform\Rector\StaticCall\StaticCallToMethodCallRector;
use Rector\Transform\ValueObject\StaticCallToMethodCall;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Transform\Rector\StaticCall\StaticCallToMethodCallRector::class)->call('configure', [[\Rector\Transform\Rector\StaticCall\StaticCallToMethodCallRector::STATIC_CALLS_TO_METHOD_CALLS => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Transform\ValueObject\StaticCallToMethodCall('Typo3RectorPrefix20210311\\Nette\\Utils\\FileSystem', 'write', 'Typo3RectorPrefix20210311\\Symplify\\SmartFileSystem\\SmartFileSystem', 'dumpFile'), new \Rector\Transform\ValueObject\StaticCallToMethodCall('Typo3RectorPrefix20210311\\Illuminate\\Support\\Facades\\Response', '*', 'Typo3RectorPrefix20210311\\Illuminate\\Contracts\\Routing\\ResponseFactory', '*')])]]);
};
