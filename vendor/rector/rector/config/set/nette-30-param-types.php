<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223;

use PHPStan\Type\BooleanType;
use PHPStan\Type\CallableType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IterableType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\UnionType;
use Rector\Core\ValueObject\MethodName;
use Rector\Nette\Rector\ClassMethod\TranslateClassMethodToVariadicsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;
use Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
return static function (\Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Nette\Rector\ClassMethod\TranslateClassMethodToVariadicsRector::class);
    # scalar type hints, see https://github.com/nette/component-model/commit/f69df2ca224cad7b07f1c8835679393263ea6771
    # scalar param types https://github.com/nette/security/commit/84024f612fb3f55f5d6e3e3e28eef1ad0388fa56
    $iterableType = new \PHPStan\Type\IterableType(new \PHPStan\Type\MixedType(), new \PHPStan\Type\MixedType());
    $services->set(\Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector::class)->call('configure', [[\Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector::PARAMETER_TYPEHINTS => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'lookup', 0, new \PHPStan\Type\UnionType([new \PHPStan\Type\StringType(), new \PHPStan\Type\NullType()])), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'lookup', 1, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'lookupPath', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'lookupPath', 1, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'monitor', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'unmonitor', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'attached', 0, new \PHPStan\Type\ObjectType('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IComponent')), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'detached', 0, new \PHPStan\Type\ObjectType('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IComponent')), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Component', 'link', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Container', 'getComponent', 1, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\Container', 'createComponent', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IComponent', 'setParent', 0, new \PHPStan\Type\UnionType([new \PHPStan\Type\ObjectType('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IContainer'), new \PHPStan\Type\NullType()])), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IComponent', 'setParent', 1, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\ComponentModel\\IContainer', 'getComponents', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Forms\\Container', 'addSelect', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Forms\\Container', 'addSelect', 3, new \PHPStan\Type\IntegerType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Forms\\Container', 'addMultiSelect', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Forms\\Container', 'addMultiSelect', 3, new \PHPStan\Type\IntegerType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Forms\\Rendering\\DefaultFormRenderer', 'render', 1, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\RadekDostal\\NetteComponents\\DateTimePicker\\DateTimePicker', 'register', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Bridges\\SecurityDI\\SecurityExtension', \Rector\Core\ValueObject\MethodName::CONSTRUCT, 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\IUserStorage', 'setAuthenticated', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\IUserStorage', 'setIdentity', 0, new \PHPStan\Type\UnionType([new \PHPStan\Type\ObjectType('Typo3RectorPrefix20210223\\Nette\\Security\\IIdentity'), new \PHPStan\Type\NullType()])), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\IUserStorage', 'setExpiration', 1, new \PHPStan\Type\IntegerType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Identity', \Rector\Core\ValueObject\MethodName::CONSTRUCT, 2, $iterableType), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Identity', '__set', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Identity', '&__get', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Identity', '__isset', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Passwords', 'hash', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Passwords', 'verify', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Passwords', 'verify', 1, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Passwords', 'needsRehash', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'addRole', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'hasRole', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'getRoleParents', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'removeRole', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'addResource', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'addResource', 1, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'hasResource', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'resourceInheritsFrom', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'resourceInheritsFrom', 1, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'resourceInheritsFrom', 2, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'removeResource', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'allow', 3, new \PHPStan\Type\CallableType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'deny', 3, new \PHPStan\Type\CallableType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'setRule', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'setRule', 1, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\Permission', 'setRule', 5, new \PHPStan\Type\CallableType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\User', 'logout', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\User', 'getAuthenticator', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\User', 'isInRole', 0, new \PHPStan\Type\StringType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\User', 'getAuthorizator', 0, new \PHPStan\Type\BooleanType()), new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('Typo3RectorPrefix20210223\\Nette\\Security\\User', 'getAuthorizator', 1, new \PHPStan\Type\StringType())])]]);
};