<?php

declare (strict_types=1);
namespace Rector\Core\Console\Command;

use Rector\Caching\Detector\ChangedFilesDetector;
use Rector\Core\Configuration\Option;
use Rector\Core\Exception\ShouldNotHappenException;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Application;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Command\Command;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Input\InputInterface;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Output\OutputInterface;
abstract class AbstractCommand extends \Typo3RectorPrefix20210311\Symfony\Component\Console\Command\Command
{
    /**
     * @var ChangedFilesDetector
     */
    protected $changedFilesDetector;
    /**
     * @required
     */
    public function autowireAbstractCommand(\Rector\Caching\Detector\ChangedFilesDetector $changedFilesDetector) : void
    {
        $this->changedFilesDetector = $changedFilesDetector;
    }
    protected function initialize(\Typo3RectorPrefix20210311\Symfony\Component\Console\Input\InputInterface $input, \Typo3RectorPrefix20210311\Symfony\Component\Console\Output\OutputInterface $output) : void
    {
        $application = $this->getApplication();
        if (!$application instanceof \Typo3RectorPrefix20210311\Symfony\Component\Console\Application) {
            throw new \Rector\Core\Exception\ShouldNotHappenException();
        }
        $optionDebug = (bool) $input->getOption(\Rector\Core\Configuration\Option::OPTION_DEBUG);
        if ($optionDebug) {
            $application->setCatchExceptions(\false);
            // clear cache
            $this->changedFilesDetector->clear();
            return;
        }
        // clear cache
        $optionClearCache = (bool) $input->getOption(\Rector\Core\Configuration\Option::OPTION_CLEAR_CACHE);
        if ($optionClearCache) {
            $this->changedFilesDetector->clear();
        }
    }
}
