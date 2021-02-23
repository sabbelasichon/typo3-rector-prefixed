<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223;

use Rector\Renaming\Rector\Name\RenameClassRector;
use Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
# see https://github.com/doctrine/persistence/pull/71
return static function (\Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Renaming\Rector\Name\RenameClassRector::class)->call('configure', [[\Rector\Renaming\Rector\Name\RenameClassRector::OLD_TO_NEW_CLASSES => ['Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Event\\LifecycleEventArgs' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Event\\LifecycleEventArgs', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Event\\LoadClassMetadataEventArgs' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Event\\LoadClassMetadataEventArgs', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Event\\ManagerEventArgs' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Event\\ManagerEventArgs', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\AbstractClassMetadataFactory' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\AbstractClassMetadataFactory', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\ClassMetadata' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\ClassMetadata', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\ClassMetadataFactory' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\ClassMetadataFactory', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\FileDriver' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\FileDriver', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriver' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\MappingDriver', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\MappingDriverChain', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\PHPDriver' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\PHPDriver', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\StaticPHPDriver' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\StaticPHPDriver', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\SymfonyFileLocator' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\SymfonyFileLocator', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\MappingException' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\MappingException', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\ReflectionService' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\ReflectionService', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\RuntimeReflectionService' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\RuntimeReflectionService', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\StaticReflectionService' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\StaticReflectionService', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\ObjectManager' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\ObjectManager', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\ObjectManagerDecorator' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\ObjectManagerDecorator', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\ObjectRepository' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\ObjectRepository', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Proxy' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Proxy', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\AbstractManagerRegistry' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\AbstractManagerRegistry', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\Mapping\\Driver\\DefaultFileLocator' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\Mapping\\Driver\\DefaultFileLocator', 'Typo3RectorPrefix20210223\\Doctrine\\Common\\Persistence\\ManagerRegistry' => 'Typo3RectorPrefix20210223\\Doctrine\\Persistence\\ManagerRegistry']]]);
};
