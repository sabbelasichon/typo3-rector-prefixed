<?php

declare (strict_types=1);
namespace Rector\RectorGenerator\Tests\RectorGenerator;

use Rector\Core\HttpKernel\RectorKernel;
use Rector\RectorGenerator\Generator\RectorRecipeGenerator;
use Rector\RectorGenerator\Tests\RectorGenerator\Source\StaticRectorRecipeFactory;
use Rector\RectorGenerator\ValueObject\RectorRecipe;
use Typo3RectorPrefix20210311\Symplify\EasyTesting\PHPUnit\Behavior\DirectoryAssertableTrait;
use Typo3RectorPrefix20210311\Symplify\PackageBuilder\Testing\AbstractKernelTestCase;
use Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem;
final class RectorGeneratorTest extends \Typo3RectorPrefix20210311\Symplify\PackageBuilder\Testing\AbstractKernelTestCase
{
    use DirectoryAssertableTrait;
    /**
     * @var string
     */
    private const DESTINATION_DIRECTORY = __DIR__ . '/__temp';
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;
    /**
     * @var RectorRecipeGenerator
     */
    private $rectorRecipeGenerator;
    protected function setUp() : void
    {
        $this->bootKernel(\Rector\Core\HttpKernel\RectorKernel::class);
        $this->smartFileSystem = $this->getService(\Typo3RectorPrefix20210311\Symplify\SmartFileSystem\SmartFileSystem::class);
        $this->rectorRecipeGenerator = $this->getService(\Rector\RectorGenerator\Generator\RectorRecipeGenerator::class);
    }
    protected function tearDown() : void
    {
        // cleanup temporary data
        $this->smartFileSystem->remove(self::DESTINATION_DIRECTORY);
    }
    public function test() : void
    {
        $rectorRecipe = $this->createConfiguration(\true);
        $this->rectorRecipeGenerator->generate($rectorRecipe, self::DESTINATION_DIRECTORY);
        $this->assertDirectoryEquals(__DIR__ . '/Fixture/expected', self::DESTINATION_DIRECTORY);
    }
    public function test3rdParty() : void
    {
        $rectorRecipe = $this->createConfiguration(\false);
        $this->rectorRecipeGenerator->generate($rectorRecipe, self::DESTINATION_DIRECTORY);
        $this->assertDirectoryEquals(__DIR__ . '/Fixture/expected_3rd_party', self::DESTINATION_DIRECTORY);
    }
    private function createConfiguration(bool $isRectorRepository) : \Rector\RectorGenerator\ValueObject\RectorRecipe
    {
        return \Rector\RectorGenerator\Tests\RectorGenerator\Source\StaticRectorRecipeFactory::createRectorRecipe($isRectorRepository);
    }
}
