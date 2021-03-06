<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Doctrine\Rector\Class_\ManagerRegistryGetManagerToEntityManagerRector;
use Rector\DoctrineCodeQuality\Rector\Class_\InitializeDefaultEntityCollectionRector;
use Rector\DoctrineCodeQuality\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector;
use Rector\DoctrineCodeQuality\Rector\Class_\RemoveRedundantDefaultClassAnnotationValuesRector;
use Rector\DoctrineCodeQuality\Rector\ClassMethod\MakeEntityDateTimePropertyDateTimeInterfaceRector;
use Rector\DoctrineCodeQuality\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector;
use Rector\DoctrineCodeQuality\Rector\Property\ChangeBigIntEntityPropertyToIntTypeRector;
use Rector\DoctrineCodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;
use Rector\DoctrineCodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;
use Rector\DoctrineCodeQuality\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector;
use Rector\Privatization\Rector\MethodCall\ReplaceStringWithClassConstantRector;
use Rector\Privatization\ValueObject\ReplaceStringWithClassConstant;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Doctrine\Rector\Class_\ManagerRegistryGetManagerToEntityManagerRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Class_\InitializeDefaultEntityCollectionRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\ClassMethod\MakeEntityDateTimePropertyDateTimeInterfaceRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Property\ChangeBigIntEntityPropertyToIntTypeRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector::class);
    $services->set(\Rector\DoctrineCodeQuality\Rector\Class_\RemoveRedundantDefaultClassAnnotationValuesRector::class);
    $services->set(\Rector\Privatization\Rector\MethodCall\ReplaceStringWithClassConstantRector::class)->call('configure', [[\Rector\Privatization\Rector\MethodCall\ReplaceStringWithClassConstantRector::REPLACE_STRING_WITH_CLASS_CONSTANT => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Privatization\ValueObject\ReplaceStringWithClassConstant('Typo3RectorPrefix20210311\\Doctrine\\ORM\\QueryBuilder', 'orderBy', 1, 'Typo3RectorPrefix20210311\\Doctrine\\Common\\Collections\\Criteria')])]]);
};
