<?php

namespace Typo3RectorPrefix20210311;

use Typo3RectorPrefix20210311\PHPUnit\Framework\TestCase;
use Rector\CodingStyle\Rector\MethodCall\PreferThisOrSelfMethodCallRector;
use Rector\CodingStyle\Tests\Rector\MethodCall\PreferThisOrSelfMethodCallRector\Source\AbstractTestCase;
use Rector\CodingStyle\Tests\Rector\MethodCall\PreferThisOrSelfMethodCallRector\Source\BeLocalClass;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\CodingStyle\Rector\MethodCall\PreferThisOrSelfMethodCallRector::class)->call('configure', [[\Rector\CodingStyle\Rector\MethodCall\PreferThisOrSelfMethodCallRector::TYPE_TO_PREFERENCE => [\Rector\CodingStyle\Tests\Rector\MethodCall\PreferThisOrSelfMethodCallRector\Source\AbstractTestCase::class => 'self', \Rector\CodingStyle\Tests\Rector\MethodCall\PreferThisOrSelfMethodCallRector\Source\BeLocalClass::class => 'this', \Typo3RectorPrefix20210311\PHPUnit\Framework\TestCase::class => 'self']]]);
};
