<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\RabbitMQ;

use Cdn77\RabbitMQBundle\DependencyInjection\Configuration;

final class Binding
{
    /** @param mixed[] $arguments */
    public function __construct(
        private Bindable $bindable,
        private string $routingKey,
        private array $arguments = [],
    ) {
    }

    /** @param mixed[] $configuration */
    public static function fromConfiguration(Bindable $bindable, array $configuration): self
    {
        return new self(
            $bindable,
            $configuration[Configuration::KEY_BINDING_ROUTING_KEY],
            $configuration[Configuration::KEY_BINDING_ARGUMENTS] ?? [],
        );
    }

    public function getBindable(): Bindable
    {
        return $this->bindable;
    }

    public function getRoutingKey(): string
    {
        return $this->routingKey;
    }

    /** @return mixed[] */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
