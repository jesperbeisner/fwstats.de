<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Stdlib\Interface;

interface LoggerInterface
{
    /**
     * @param mixed[] $context
     */
    public function log(string $level, string $message, array $context = []): void;

    /**
     * @param mixed[] $context
     */
    public function info(string $message, array $context = []): void;

    /**
     * @param mixed[] $context
     */
    public function error(string $message, array $context = []): void;
}
