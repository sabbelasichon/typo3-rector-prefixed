<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223;

use Rector\CakePHP\Rector\MethodCall\ModalToGetSetRector;
use Rector\CakePHP\ValueObject\ModalToGetSet;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
# source: https://book.cakephp.org/3.0/en/appendices/3-5-migration-guide.html
return static function (\Typo3RectorPrefix20210223\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Renaming\Rector\Name\RenameClassRector::class)->call('configure', [[\Rector\Renaming\Rector\Name\RenameClassRector::OLD_TO_NEW_CLASSES => ['Typo3RectorPrefix20210223\\Cake\\Http\\Client\\CookieCollection' => 'Typo3RectorPrefix20210223\\Cake\\Http\\Cookie\\CookieCollection', 'Typo3RectorPrefix20210223\\Cake\\Console\\ShellDispatcher' => 'Typo3RectorPrefix20210223\\Cake\\Console\\CommandRunner']]]);
    $services->set(\Rector\Renaming\Rector\MethodCall\RenameMethodRector::class)->call('configure', [[\Rector\Renaming\Rector\MethodCall\RenameMethodRector::METHOD_CALL_RENAMES => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\Renaming\ValueObject\MethodCallRename('Typo3RectorPrefix20210223\\Cake\\Database\\Schema\\TableSchema', 'column', 'getColumn'), new \Rector\Renaming\ValueObject\MethodCallRename('Typo3RectorPrefix20210223\\Cake\\Database\\Schema\\TableSchema', 'constraint', 'getConstraint'), new \Rector\Renaming\ValueObject\MethodCallRename('Typo3RectorPrefix20210223\\Cake\\Database\\Schema\\TableSchema', 'index', 'getIndex')])]]);
    $services->set(\Rector\CakePHP\Rector\MethodCall\ModalToGetSetRector::class)->call('configure', [[\Rector\CakePHP\Rector\MethodCall\ModalToGetSetRector::UNPREFIXED_METHODS_TO_GET_SET => \Symplify\SymfonyPhpConfig\ValueObjectInliner::inline([new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Cache\\Cache', 'config'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Cache\\Cache', 'registry'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Console\\Shell', 'io'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Console\\ConsoleIo', 'outputAs'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Console\\ConsoleOutput', 'outputAs'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\Connection', 'logger'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\TypedResultInterface', 'returnType'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\TypedResultTrait', 'returnType'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\Log\\LoggingStatement', 'logger'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Datasource\\ModelAwareTrait', 'modelType'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\Query', 'valueBinder', 'getValueBinder', 'valueBinder'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Database\\Schema\\TableSchema', 'columnType'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Datasource\\QueryTrait', 'eagerLoaded', 'isEagerLoaded', 'eagerLoaded'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Event\\EventDispatcherInterface', 'eventManager'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Event\\EventDispatcherTrait', 'eventManager'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Error\\Debugger', 'outputAs', 'getOutputFormat', 'setOutputFormat'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Http\\ServerRequest', 'env', 'getEnv', 'withEnv'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Http\\ServerRequest', 'charset', 'getCharset', 'withCharset'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\I18n\\I18n', 'locale'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\I18n\\I18n', 'translator'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\I18n\\I18n', 'defaultLocale'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\I18n\\I18n', 'defaultFormatter'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\ORM\\Association\\BelongsToMany', 'sort'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\ORM\\LocatorAwareTrait', 'tableLocator'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\ORM\\Table', 'validator'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Routing\\RouteBuilder', 'extensions'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Routing\\RouteBuilder', 'routeClass'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Routing\\RouteCollection', 'extensions'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\TestSuite\\TestFixture', 'schema'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\Utility\\Security', 'salt'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'template'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'layout'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'theme'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'templatePath'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'layoutPath'), new \Rector\CakePHP\ValueObject\ModalToGetSet('Typo3RectorPrefix20210223\\Cake\\View\\View', 'autoLayout', 'isAutoLayoutEnabled', 'enableAutoLayout')])]]);
};