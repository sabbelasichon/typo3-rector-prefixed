<?php

declare (strict_types=1);
namespace Rector\Core\HttpKernel;

use Rector\Core\Contract\Rector\RectorInterface;
use Rector\Core\DependencyInjection\Collector\ConfigureCallValuesCollector;
use Rector\Core\DependencyInjection\CompilerPass\MakeRectorsPublicCompilerPass;
use Rector\Core\DependencyInjection\CompilerPass\MergeImportedRectorConfigureCallValuesCompilerPass;
use Rector\Core\DependencyInjection\Loader\ConfigurableCallValuesCollectingPhpFileLoader;
use Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\DelegatingLoader;
use Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\GlobFileLoader;
use Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\LoaderInterface;
use Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\LoaderResolver;
use Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\ContainerBuilder;
use Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\ContainerInterface;
use Typo3RectorPrefix20210227\Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Typo3RectorPrefix20210227\Symfony\Component\HttpKernel\Config\FileLocator;
use Typo3RectorPrefix20210227\Symfony\Component\HttpKernel\Kernel;
use Typo3RectorPrefix20210227\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass;
use Typo3RectorPrefix20210227\Symplify\ComposerJsonManipulator\Bundle\ComposerJsonManipulatorBundle;
use Typo3RectorPrefix20210227\Symplify\ConsoleColorDiff\Bundle\ConsoleColorDiffBundle;
use Typo3RectorPrefix20210227\Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface;
use Typo3RectorPrefix20210227\Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass;
use Typo3RectorPrefix20210227\Symplify\PhpConfigPrinter\Bundle\PhpConfigPrinterBundle;
use Typo3RectorPrefix20210227\Symplify\SimplePhpDocParser\Bundle\SimplePhpDocParserBundle;
use Typo3RectorPrefix20210227\Symplify\Skipper\Bundle\SkipperBundle;
final class RectorKernel extends \Typo3RectorPrefix20210227\Symfony\Component\HttpKernel\Kernel implements \Typo3RectorPrefix20210227\Symplify\PackageBuilder\Contract\HttpKernel\ExtraConfigAwareKernelInterface
{
    /**
     * @var string[]
     */
    private $configs = [];
    /**
     * @var ConfigureCallValuesCollector
     */
    private $configureCallValuesCollector;
    public function __construct(string $environment, bool $debug)
    {
        $this->configureCallValuesCollector = new \Rector\Core\DependencyInjection\Collector\ConfigureCallValuesCollector();
        parent::__construct($environment, $debug);
    }
    public function getCacheDir() : string
    {
        // manually configured, so it can be replaced in phar
        return \sys_get_temp_dir() . '/_rector';
    }
    public function getLogDir() : string
    {
        // manually configured, so it can be replaced in phar
        return \sys_get_temp_dir() . '/_rector_log';
    }
    public function registerContainerConfiguration(\Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\LoaderInterface $loader) : void
    {
        $loader->load(__DIR__ . '/../../config/config.php');
        foreach ($this->configs as $config) {
            $loader->load($config);
        }
    }
    /**
     * @param string[] $configs
     */
    public function setConfigs(array $configs) : void
    {
        $this->configs = $configs;
    }
    /**
     * @return BundleInterface[]
     */
    public function registerBundles() : array
    {
        return [new \Typo3RectorPrefix20210227\Symplify\ConsoleColorDiff\Bundle\ConsoleColorDiffBundle(), new \Typo3RectorPrefix20210227\Symplify\PhpConfigPrinter\Bundle\PhpConfigPrinterBundle(), new \Typo3RectorPrefix20210227\Symplify\ComposerJsonManipulator\Bundle\ComposerJsonManipulatorBundle(), new \Typo3RectorPrefix20210227\Symplify\Skipper\Bundle\SkipperBundle(), new \Typo3RectorPrefix20210227\Symplify\SimplePhpDocParser\Bundle\SimplePhpDocParserBundle()];
    }
    protected function build(\Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $containerBuilder->addCompilerPass(new \Typo3RectorPrefix20210227\Symplify\AutowireArrayParameter\DependencyInjection\CompilerPass\AutowireArrayParameterCompilerPass());
        // autowire Rectors by default (mainly for 3rd party code)
        $containerBuilder->addCompilerPass(new \Typo3RectorPrefix20210227\Symplify\PackageBuilder\DependencyInjection\CompilerPass\AutowireInterfacesCompilerPass([\Rector\Core\Contract\Rector\RectorInterface::class]));
        $containerBuilder->addCompilerPass(new \Rector\Core\DependencyInjection\CompilerPass\MakeRectorsPublicCompilerPass());
        // add all merged arguments of Rector services
        $containerBuilder->addCompilerPass(new \Rector\Core\DependencyInjection\CompilerPass\MergeImportedRectorConfigureCallValuesCompilerPass($this->configureCallValuesCollector));
    }
    /**
     * This allows to use "%vendor%" variables in imports
     * @param ContainerInterface|ContainerBuilder $container
     */
    protected function getContainerLoader(\Typo3RectorPrefix20210227\Symfony\Component\DependencyInjection\ContainerInterface $container) : \Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\DelegatingLoader
    {
        $fileLocator = new \Typo3RectorPrefix20210227\Symfony\Component\HttpKernel\Config\FileLocator($this);
        $loaderResolver = new \Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\LoaderResolver([new \Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\GlobFileLoader($fileLocator), new \Rector\Core\DependencyInjection\Loader\ConfigurableCallValuesCollectingPhpFileLoader($container, $fileLocator, $this->configureCallValuesCollector)]);
        return new \Typo3RectorPrefix20210227\Symfony\Component\Config\Loader\DelegatingLoader($loaderResolver);
    }
}
