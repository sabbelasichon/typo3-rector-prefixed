<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Typo3RectorPrefix20210223\Symfony\Component\HttpKernel\CacheClearer;

/**
 * ChainCacheClearer.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 *
 * @final
 */
class ChainCacheClearer implements \Typo3RectorPrefix20210223\Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface
{
    private $clearers;
    public function __construct(iterable $clearers = [])
    {
        $this->clearers = $clearers;
    }
    /**
     * {@inheritdoc}
     */
    public function clear(string $cacheDir)
    {
        foreach ($this->clearers as $clearer) {
            $clearer->clear($cacheDir);
        }
    }
}