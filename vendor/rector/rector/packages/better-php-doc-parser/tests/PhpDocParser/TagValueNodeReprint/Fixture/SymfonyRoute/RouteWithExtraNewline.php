<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\Tests\PhpDocParser\TagValueNodeReprint\Fixture\SymfonyRoute;

use Typo3RectorPrefix20210311\Symfony\Component\Routing\Annotation\Route;
final class RouteWithExtraNewline
{
    /**
     * @Route(
     *    path="/remove", name="route_name"
     * )
     */
    public function run()
    {
    }
}
