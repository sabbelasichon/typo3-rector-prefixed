<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311\Doctrine\Inflector;

class NoopWordInflector implements \Typo3RectorPrefix20210311\Doctrine\Inflector\WordInflector
{
    public function inflect(string $word) : string
    {
        return $word;
    }
}
