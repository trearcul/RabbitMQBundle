<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\RabbitMQ\Consumer;

final class Configuration
{
    public function __construct(
        private string $queueName,
        private int $prefetchCount = 1,
        private int $prefetchSize = 0,
        private int|null $maxMessages = null,
        private float|null $maxSeconds = null,
    ) {
    }

    public function getQueueName(): string
    {
        return $this->queueName;
    }

    public function getPrefetchCount(): int
    {
        return $this->prefetchCount;
    }

    public function getPrefetchSize(): int
    {
        return $this->prefetchSize;
    }

    public function getMaxMessages(): int|null
    {
        return $this->maxMessages;
    }

    public function getMaxSeconds(): float|null
    {
        return $this->maxSeconds;
    }
}
