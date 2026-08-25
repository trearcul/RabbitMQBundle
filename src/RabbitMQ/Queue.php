<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\RabbitMQ;

use Cdn77\RabbitMQBundle\DependencyInjection\Configuration;

final class Queue implements Bindable
{
    /** @var Binding[] */
    private array $bindings = [];

    /** @param mixed[] $arguments */
    public function __construct(
        private string $name,
        private bool $durable = false,
        private bool $exclusive = false,
        private bool $autoDelete = false,
        private array $arguments = [],
    ) {
    }

    /** @param mixed[] $configuration */
    public static function fromConfiguration(string $name, array $configuration): self
    {
        return new self(
            $name,
            $configuration[Configuration::KEY_QUEUE_DURABLE] ?? false,
            $configuration[Configuration::KEY_QUEUE_EXCLUSIVE] ?? false,
            $configuration[Configuration::KEY_QUEUE_AUTO_DELETE] ?? false,
            $configuration[Configuration::KEY_QUEUE_ARGUMENTS] ?? [],
        );
    }

    public function addBinding(Binding $binding): void
    {
        $this->bindings[] = $binding;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isDurable(): bool
    {
        return $this->durable;
    }

    /** @return Binding[] */
    public function getBindings(): array
    {
        return $this->bindings;
    }

    public function isExclusive(): bool
    {
        return $this->exclusive;
    }

    public function shouldAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    /** @return mixed[] */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
