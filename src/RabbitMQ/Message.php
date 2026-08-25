<?php

declare(strict_types=1);

namespace Cdn77\RabbitMQBundle\RabbitMQ;

class Message
{
    public const string HEADER_CONTENT_TYPE = 'content-type';
    public const string HEADER_DELIVERY_MODE = 'delivery-mode';

    /** @param mixed[] $headers */
    public function __construct(
        public string $body,
        public array $headers = [],
    ) {
        $this->headers[self::HEADER_DELIVERY_MODE] ??= DeliveryMode::PERSISTENT;
    }

    /** @param mixed[] $headers */
    public static function json(string $body, array $headers = []): self
    {
        return new self($body, [self::HEADER_CONTENT_TYPE => 'application/json'] + $headers);
    }

    public static function fromBunny(\Bunny\Message $message): self
    {
        return new self($message->content, $message->headers);
    }

    public function makeTransient(): self
    {
        $this->headers[self::HEADER_DELIVERY_MODE] = DeliveryMode::TRANSIENT;

        return $this;
    }
}
