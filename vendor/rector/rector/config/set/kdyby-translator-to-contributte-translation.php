<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311;

use Rector\Renaming\Rector\Name\RenameClassRector;
use Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Typo3RectorPrefix20210311\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->set(\Rector\Renaming\Rector\Name\RenameClassRector::class)->call('configure', [[\Rector\Renaming\Rector\Name\RenameClassRector::OLD_TO_NEW_CLASSES => ['Typo3RectorPrefix20210311\\Kdyby\\Translation\\Translator' => 'Typo3RectorPrefix20210311\\Nette\\Localization\\ITranslator', 'Typo3RectorPrefix20210311\\Kdyby\\Translation\\DI\\ITranslationProvider' => 'Typo3RectorPrefix20210311\\Contributte\\Translation\\DI\\TranslationProviderInterface', 'Typo3RectorPrefix20210311\\Kdyby\\Translation\\Phrase' => 'Typo3RectorPrefix20210311\\Contributte\\Translation\\Wrappers\\Message']]]);
};
