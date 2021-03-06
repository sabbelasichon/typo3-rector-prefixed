<?php

declare (strict_types=1);
namespace Rector\Doctrine\PostRunner;

use Typo3RectorPrefix20210311\Nette\Utils\Json;
use Rector\Core\Contract\PostRunnerInterface;
use Rector\Doctrine\Collector\UuidMigrationDataCollector;
use Typo3RectorPrefix20210311\Symfony\Component\Console\Style\SymfonyStyle;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem;
/**
 * @deprecated Replace with interface. Remove whole event system to keep 1 less pattern for same thing
 */
final class ReportEntitiesWithAddedPropertiesPostRunner implements \Rector\Core\Contract\PostRunnerInterface
{
    /**
     * @var UuidMigrationDataCollector
     */
    private $uuidMigrationDataCollector;
    /**
     * @var SymfonyStyle
     */
    private $symfonyStyle;
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem $smartFileSystem, \Typo3RectorPrefix20210311\Symfony\Component\Console\Style\SymfonyStyle $symfonyStyle, \Rector\Doctrine\Collector\UuidMigrationDataCollector $uuidMigrationDataCollector)
    {
        $this->uuidMigrationDataCollector = $uuidMigrationDataCollector;
        $this->symfonyStyle = $symfonyStyle;
        $this->smartFileSystem = $smartFileSystem;
    }
    public function run() : void
    {
        $this->generatePropertiesJsonWithFileName('uuid-migration-new-column-properties.json', $this->uuidMigrationDataCollector->getColumnPropertiesByClass());
        $this->generatePropertiesJsonWithFileName('uuid-migration-new-relation-properties.json', $this->uuidMigrationDataCollector->getRelationPropertiesByClass());
    }
    /**
     * @param mixed[] $data
     */
    private function generatePropertiesJsonWithFileName(string $fileName, array $data) : void
    {
        if ($data === []) {
            return;
        }
        $jsonContent = \Typo3RectorPrefix20210311\Nette\Utils\Json::encode(['new_columns_by_class' => $data], \Typo3RectorPrefix20210311\Nette\Utils\Json::PRETTY);
        $filePath = \getcwd() . '/' . $fileName;
        $this->smartFileSystem->dumpFile($filePath, $jsonContent);
        $message = \sprintf('See freshly created "%s" file for changes on entities', $fileName);
        $this->symfonyStyle->warning($message);
    }
}
