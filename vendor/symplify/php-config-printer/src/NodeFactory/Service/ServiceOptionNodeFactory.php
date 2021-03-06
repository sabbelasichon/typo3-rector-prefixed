<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\NodeFactory\Service;

use Typo3RectorPrefix20210311\Nette\Utils\Strings;
use PhpParser\Node\Expr\MethodCall;
use Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\Contract\Converter\ServiceOptionsKeyYamlToPhpFactoryInterface;
use Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\ServiceOptionAnalyzer\ServiceOptionAnalyzer;
use Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey;
final class ServiceOptionNodeFactory
{
    /**
     * @var ServiceOptionsKeyYamlToPhpFactoryInterface[]
     */
    private $serviceOptionKeyYamlToPhpFactories = [];
    /**
     * @var ServiceOptionAnalyzer
     */
    private $serviceOptionAnalyzer;
    /**
     * @param ServiceOptionsKeyYamlToPhpFactoryInterface[] $serviceOptionKeyYamlToPhpFactories
     */
    public function __construct(\Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\ServiceOptionAnalyzer\ServiceOptionAnalyzer $serviceOptionAnalyzer, array $serviceOptionKeyYamlToPhpFactories)
    {
        $this->serviceOptionKeyYamlToPhpFactories = $serviceOptionKeyYamlToPhpFactories;
        $this->serviceOptionAnalyzer = $serviceOptionAnalyzer;
    }
    /**
     * @param mixed[] $servicesValues
     */
    public function convertServiceOptionsToNodes(array $servicesValues, \PhpParser\Node\Expr\MethodCall $methodCall) : \PhpParser\Node\Expr\MethodCall
    {
        $servicesValues = $this->unNestArguments($servicesValues);
        foreach ($servicesValues as $key => $value) {
            if ($this->shouldSkip($key)) {
                continue;
            }
            foreach ($this->serviceOptionKeyYamlToPhpFactories as $serviceOptionKeyYamlToPhpFactory) {
                if (!$serviceOptionKeyYamlToPhpFactory->isMatch($key, $value)) {
                    continue;
                }
                $methodCall = $serviceOptionKeyYamlToPhpFactory->decorateServiceMethodCall($key, $value, $servicesValues, $methodCall);
                continue 2;
            }
        }
        return $methodCall;
    }
    /**
     * @return array<string, mixed>
     */
    private function unNestArguments(array $servicesValues) : array
    {
        if (!$this->serviceOptionAnalyzer->hasNamedArguments($servicesValues)) {
            return $servicesValues;
        }
        return [\Typo3RectorPrefix20210311\Symplify\PhpConfigPrinter\ValueObject\YamlServiceKey::ARGUMENTS => $servicesValues];
    }
    private function shouldSkip(string $key) : bool
    {
        // options started by decoration_<option> are used as options of the method decorate().
        if (\Typo3RectorPrefix20210311\Nette\Utils\Strings::startsWith($key, 'decoration_')) {
            return \true;
        }
        return $key === 'alias';
    }
}
