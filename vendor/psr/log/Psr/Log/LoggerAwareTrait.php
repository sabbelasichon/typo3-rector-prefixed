<?php

namespace Typo3RectorPrefix20210311\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(\Typo3RectorPrefix20210311\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
