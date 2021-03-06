<?php

declare (strict_types=1);
namespace Typo3RectorPrefix20210311\Symplify\AutowireArrayParameter\TypeResolver;

use Typo3RectorPrefix20210311\Nette\Utils\Reflection;
use ReflectionMethod;
use Typo3RectorPrefix20210311\Symplify\AutowireArrayParameter\DocBlock\ParamTypeDocBlockResolver;
final class ParameterTypeResolver
{
    /**
     * @var ParamTypeDocBlockResolver
     */
    private $paramTypeDocBlockResolver;
    /**
     * @var array<string, string>
     */
    private $resolvedParameterTypesCached = [];
    public function __construct(\Typo3RectorPrefix20210311\Symplify\AutowireArrayParameter\DocBlock\ParamTypeDocBlockResolver $paramTypeDocBlockResolver)
    {
        $this->paramTypeDocBlockResolver = $paramTypeDocBlockResolver;
    }
    public function resolveParameterType(string $parameterName, \ReflectionMethod $reflectionMethod) : ?string
    {
        $docComment = $reflectionMethod->getDocComment();
        if ($docComment === \false) {
            return null;
        }
        $declaringClassReflection = $reflectionMethod->getDeclaringClass();
        $uniqueKey = $parameterName . $declaringClassReflection->getName() . $reflectionMethod->getName();
        if (isset($this->resolvedParameterTypesCached[$uniqueKey])) {
            return $this->resolvedParameterTypesCached[$uniqueKey];
        }
        $resolvedType = $this->paramTypeDocBlockResolver->resolve($docComment, $parameterName);
        if ($resolvedType === null) {
            return null;
        }
        // not a class|interface type
        if (\ctype_lower($resolvedType[0])) {
            return null;
        }
        $resolvedClass = \Typo3RectorPrefix20210311\Nette\Utils\Reflection::expandClassName($resolvedType, $declaringClassReflection);
        $this->resolvedParameterTypesCached[$uniqueKey] = $resolvedClass;
        return $resolvedClass;
    }
}
