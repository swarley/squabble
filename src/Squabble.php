<?php

namespace Swarley\Squabble;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Str;
use ReflectionType;
use Swarley\Squabble\Attributes\SquabbleRequest;
use Swarley\Squabble\Attributes\SquabbleResponse;
use Symfony\Component\HttpFoundation\Response;

class Squabble {
    public static function getRoutes(): Collection
    {
        $prefixes = collect(config('squabble.namespace'));

        $allRoutes = RouteFacade::getRoutes()->getRoutesByName();

        return collect($allRoutes)
            ->filter(fn ($_route, $key) => $prefixes->some(fn ($prefix) => Str::of($key)->is($prefix)));
    }

    /**
     * @param Route $route
     * @return class-string<FormRequest>|null
     */
    public static function getRequestFromRoute(Route $route): ?string
    {
        $reflection = new \ReflectionFunction($route->getAction('uses'));

        if ($formRequest = self::extractFormRequestFromAttributes($reflection)) {
            return $formRequest;
        }

        return self::extractFormRequestFromParameters($reflection);
    }

    public static function getResponseFromRoute(Route $route): ?string
    {
        $reflection = new \ReflectionFunction($route->getAction('uses'));

        if ($formRequest = self::extractResponseFromAttributes($reflection)) {
            return $formRequest;
        }

        return self::extractResponseFromReturnType($reflection);
    }

    private static function isFormRequestType(?ReflectionType $type): bool
    {
        if (empty($type)) {
            return false;
        }

        return collect(method_exists($type, 'getTypes') ? $type->getTypes() : [$type])
            ->some(fn ($type) => is_subclass_of((string)$type, FormRequest::class));
    }

    private static function extractFormRequestType(ReflectionType $type): ?string
    {
        return collect(method_exists($type, 'getTypes') ? $type->getTypes() : [$type])
            ->filter(fn ($type) => is_subclass_of((string)$type, FormRequest::class))
            ->first()
            ?->__toString();
    }

    private static function extractFormRequestFromAttributes(\ReflectionFunction $func): ?string
    {
        /** @var ?\ReflectionAttribute $attribute */
        $attribute = current($func->getAttributes(SquabbleRequest::class));

        if (empty($attribute)) {
            return null;
        }

        if (empty($attribute->getArguments())) {
            return null;
        }

        return $attribute->getArguments()[0];
    }

    private static function extractFormRequestFromParameters(\ReflectionFunction $func): ?string
    {
        $formParam = collect($func->getParameters())
            ->map
            ->getType()
            ->filter(fn (?ReflectionType $type) => self::isFormRequestType($type))
            ->first();

        if (empty($formParam)) {
            return null;
        }

        return self::extractFormRequestType($formParam);
    }

    private static function isResponseType(?ReflectionType $type): bool
    {
        if (empty($type)) {
            return false;
        }

        return collect(method_exists($type, 'getTypes') ? $type->getTypes() : [$type])
            ->some(fn ($type) => is_subclass_of((string)$type, Response::class));
    }

    private static function extractResponseType(ReflectionType $type): ?string
    {
        return collect(method_exists($type, 'getTypes') ? $type->getTypes() : [$type])
            ->filter(fn ($type) => is_subclass_of((string)$type, Response::class))
            ->first()
            ?->__toString();
    }

    private static function extractResponseFromAttributes(\ReflectionFunction $func): ?string
    {
        /** @var ?\ReflectionAttribute $attribute */
        $attribute = current($func->getAttributes(SquabbleResponse::class));

        if (empty($attribute)) {
            return null;
        }

        if (empty($attribute->getArguments())) {
            return null;
        }

        return $attribute->getArguments()[0];
    }

    private static function extractResponseFromReturnType(\ReflectionFunction $func): ?string
    {
        $returnType = $func->getReturnType();

        if (empty($returnType)) {
            return null;
        }

        return self::extractResponseType($returnType);
    }
}
