<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\Tests\PhpDocParser\TagValueNodeReprint\Fixture\SymfonyRoute;

use Typo3RectorPrefix20210223\Symfony\Component\Routing\Annotation\Route;
use Rector\BetterPhpDocParser\Tests\PhpDocParser\TagValueNodeReprint\Source\MyController;
final class RouteNameWithMethodAndClassConstant
{
    /**
     * @Route("/", methods={"GET", "POST"}, name=MyController::ROUTE_NAME)
     */
    public function run()
    {
    }
}