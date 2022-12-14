<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Repository;

use Jesperbeisner\Fwstats\Interface\DatabaseInterface;

abstract class AbstractRepository
{
    public function __construct(
        protected readonly DatabaseInterface $database,
    ) {
    }
}
