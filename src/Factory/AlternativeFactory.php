<?php

namespace App\Factory;

use App\Entity\Alternative;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Alternative>
 */
final class AlternativeFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Alternative::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function defaults(): array|callable
    {
        return [
            'description' => self::faker()->text(),
            'isCorrect' => self::faker()->boolean(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Alternative $alternative): void {})
        ;
    }
}
