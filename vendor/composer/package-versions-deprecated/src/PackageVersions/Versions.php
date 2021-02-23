<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210223\PackageVersions;

use Typo3RectorPrefix20210223\Composer\InstalledVersions;
use OutOfBoundsException;
\class_exists(\Typo3RectorPrefix20210223\Composer\InstalledVersions::class);
/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'ssch/typo3-rector';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS = array('composer/package-versions-deprecated' => '1.11.99.1@7413f0b55a051e89485c5cb9f765fe24bb02a7b6', 'composer/semver' => '3.2.4@a02fdf930a3c1c3ed3a49b5f63859c0c20e10464', 'composer/xdebug-handler' => '1.4.5@f28d44c286812c714741478d968104c5e604a1d4', 'doctrine/annotations' => '1.12.1@b17c5014ef81d212ac539f07a1001832df1b6d3b', 'doctrine/inflector' => '2.0.3@9cf661f4eb38f7c881cac67c75ea9b00bf97b210', 'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042', 'jean85/pretty-package-versions' => '1.6.0@1e0104b46f045868f11942aea058cd7186d6c303', 'nette/finder' => 'v2.5.2@4ad2c298eb8c687dd0e74ae84206a4186eeaed50', 'nette/neon' => 'v3.2.1@a5b3a60833d2ef55283a82d0c30b45d136b29e75', 'nette/robot-loader' => 'v3.3.1@15c1ecd0e6e69e8d908dfc4cca7b14f3b850a96b', 'nette/utils' => 'v3.2.1@2bc2f58079c920c2ecbb6935645abf6f2f5f94ba', 'nikic/php-parser' => 'v4.10.4@c6d052fc58cb876152f89f532b95a8d7907e7f0e', 'phpstan/phpdoc-parser' => '0.4.11@2ce4c6623376d2613cf02e055ea1a926d906cef7', 'phpstan/phpstan' => '0.12.78@eecce8d2ee3cac6769f37b4cb1998b2715f82984', 'phpstan/phpstan-phpunit' => '0.12.17@432575b41cf2d4f44e460234acaf56119ed97d36', 'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8', 'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f', 'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0', 'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc', 'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b', 'rector/rector' => '0.9.30@8c079420dc169a6398cb6a99ee3f5e5015898923', 'sebastian/diff' => '4.0.4@3461e3fccc7cfdfc2720be910d3bd73c69be590d', 'symfony/cache' => 'v5.2.3@d6aed6c1bbf6f59e521f46437475a0ff4878d388', 'symfony/cache-contracts' => 'v2.2.0@8034ca0b61d4dd967f3698aaa1da2507b631d0cb', 'symfony/config' => 'v5.2.3@50e0e1314a3b2609d32b6a5a0d0fb5342494c4ab', 'symfony/console' => 'v5.2.3@89d4b176d12a2946a1ae4e34906a025b7b6b135a', 'symfony/dependency-injection' => 'v5.2.3@62f72187be689540385dce6c68a5d4c16f034139', 'symfony/deprecation-contracts' => 'v2.2.0@5fa56b4074d1ae755beb55617ddafe6f5d78f665', 'symfony/error-handler' => 'v5.2.3@48f18b3609e120ea66d59142c23dc53e9562c26d', 'symfony/event-dispatcher' => 'v5.2.3@4f9760f8074978ad82e2ce854dff79a71fe45367', 'symfony/event-dispatcher-contracts' => 'v2.2.0@0ba7d54483095a198fa51781bc608d17e84dffa2', 'symfony/expression-language' => 'v5.2.3@7bf30a4e29887110f8bd1882ccc82ee63c8a5133', 'symfony/filesystem' => 'v5.2.3@262d033b57c73e8b59cd6e68a45c528318b15038', 'symfony/finder' => 'v5.2.3@4adc8d172d602008c204c2e16956f99257248e03', 'symfony/http-client-contracts' => 'v2.3.1@41db680a15018f9c1d4b23516059633ce280ca33', 'symfony/http-foundation' => 'v5.2.3@20c554c0f03f7cde5ce230ed248470cccbc34c36', 'symfony/http-kernel' => 'v5.2.3@89bac04f29e7b0b52f9fa6a4288ca7a8f90a1a05', 'symfony/polyfill-ctype' => 'v1.22.1@c6c942b1ac76c82448322025e084cadc56048b4e', 'symfony/polyfill-intl-grapheme' => 'v1.22.1@5601e09b69f26c1828b13b6bb87cb07cddba3170', 'symfony/polyfill-intl-normalizer' => 'v1.22.1@43a0283138253ed1d48d352ab6d0bdb3f809f248', 'symfony/polyfill-mbstring' => 'v1.22.1@5232de97ee3b75b0360528dae24e73db49566ab1', 'symfony/polyfill-php73' => 'v1.22.1@a678b42e92f86eca04b7fa4c0f6f19d097fb69e2', 'symfony/polyfill-php80' => 'v1.22.1@dc3063ba22c2a1fd2f45ed856374d79114998f91', 'symfony/process' => 'v5.2.3@313a38f09c77fbcdc1d223e57d368cea76a2fd2f', 'symfony/service-contracts' => 'v2.2.0@d15da7ba4957ffb8f1747218be9e1a121fd298a1', 'symfony/string' => 'v5.2.3@c95468897f408dd0aca2ff582074423dd0455122', 'symfony/var-dumper' => 'v5.2.3@72ca213014a92223a5d18651ce79ef441c12b694', 'symfony/var-exporter' => 'v5.2.3@5aed4875ab514c8cb9b6ff4772baa25fa4c10307', 'symfony/yaml' => 'v5.2.3@338cddc6d74929f6adf19ca5682ac4b8e109cdb0', 'symplify/astral' => '9.2.1@7e8ed90175d10aa86e0e36862310cd6f2dee29b3', 'symplify/autowire-array-parameter' => '9.2.1@3fc0c1f68aabb5e56fb2671643907d80b33d0487', 'symplify/composer-json-manipulator' => '9.2.1@997aadc6b2313cc5ecb471b19cc2fe5e60a27d54', 'symplify/console-color-diff' => '9.2.1@b7838780a923aa3ce6a625b4a5fa398e0b6cf5f4', 'symplify/console-package-builder' => '9.2.1@c477a53746a8d1abee06835c01c2102ae6c6d4d3', 'symplify/easy-testing' => '9.2.1@7b29bb2ddf8b40cac306b4ccaff0920d2b5d15b2', 'symplify/markdown-diff' => '9.2.1@e29bf0e4077bb11c59dc8faea33e938d14c9d732', 'symplify/package-builder' => '9.2.1@5a33c69e9f6c59f14fbf6226d214e50837aa63b2', 'symplify/php-config-printer' => '9.2.1@080b4a6f7355461b5597255b04398f4a2d5a595d', 'symplify/rule-doc-generator' => '9.2.1@dfeb610486dac0636e11a05fc653ab7ebcb60d7e', 'symplify/set-config-resolver' => '9.2.1@154969c3bb2d36e87a4711bc1feacf9adc1c04fc', 'symplify/simple-php-doc-parser' => '9.2.1@2868255311e934c5d0633bbb1dc3400e86d64342', 'symplify/skipper' => '9.2.1@0c39f032950117ec3b42e0897728302c23159fc4', 'symplify/smart-file-system' => '9.2.1@ef20e90676db3af6397de2b0dd86fb902cf872da', 'symplify/symfony-php-config' => '9.2.1@63cc895d2a3c04486e812194aac3761eb475828a', 'symplify/symplify-kernel' => '9.2.1@1aa752f4f2db5728a9b7581f62fdb931a66b0b64', 'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389', 'ssch/typo3-rector' => 'v0.9.4@6ffff1f96bfb4780061254704b001aadc81442cf');
    private function __construct()
    {
    }
    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!\class_exists(\Typo3RectorPrefix20210223\Composer\InstalledVersions::class, \false) || !\Typo3RectorPrefix20210223\Composer\InstalledVersions::getRawData()) {
            return self::ROOT_PACKAGE_NAME;
        }
        return \Typo3RectorPrefix20210223\Composer\InstalledVersions::getRootPackage()['name'];
    }
    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName) : string
    {
        if (\class_exists(\Typo3RectorPrefix20210223\Composer\InstalledVersions::class, \false) && \Typo3RectorPrefix20210223\Composer\InstalledVersions::getRawData()) {
            return \Typo3RectorPrefix20210223\Composer\InstalledVersions::getPrettyVersion($packageName) . '@' . \Typo3RectorPrefix20210223\Composer\InstalledVersions::getReference($packageName);
        }
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }
        throw new \OutOfBoundsException('Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files');
    }
}