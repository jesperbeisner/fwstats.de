<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Controller\Factory;

use Jesperbeisner\Fwstats\Controller\SecurityController;
use Jesperbeisner\Fwstats\Repository\UserRepository;
use Jesperbeisner\Fwstats\Stdlib\Interface\ContainerInterface;
use Jesperbeisner\Fwstats\Stdlib\Interface\FactoryInterface;
use Jesperbeisner\Fwstats\Stdlib\Interface\SessionInterface;
use Jesperbeisner\Fwstats\Stdlib\Request;

final class SecurityControllerFactory implements FactoryInterface
{
    public function build(ContainerInterface $container, string $serviceId): SecurityController
    {
        /** @var Request $request */
        $request = $container->get(Request::class);

        /** @var SessionInterface $session */
        $session = $container->get(SessionInterface::class);

        /** @var UserRepository $userRepository */
        $userRepository = $container->get(UserRepository::class);

        return new SecurityController(
            $request,
            $session,
            $userRepository,
        );
    }
}
