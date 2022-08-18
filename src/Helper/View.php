<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Helper;

use Jesperbeisner\Fwstats\DTO\Player;

final class View
{
    public static function escape(string $text): string
    {
        return htmlspecialchars($text);
    }

    public static function numberFormat(int $number): string
    {
        return number_format((float) $number, 0, '', '.');
    }

    public static function shortNames(string $name): string
    {
        if (strlen($name) > 20) {
            return substr($name, 0, 20) . '...';
        }

        return $name;
    }
}
