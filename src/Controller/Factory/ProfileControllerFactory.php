<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Controller\Factory;

use Jesperbeisner\Fwstats\Controller\ProfileController;
use Jesperbeisner\Fwstats\Interface\ContainerInterface;
use Jesperbeisner\Fwstats\Interface\FactoryInterface;
use Jesperbeisner\Fwstats\Repository\PlayerNameHistoryRepository;
use Jesperbeisner\Fwstats\Repository\PlayerProfessionHistoryRepository;
use Jesperbeisner\Fwstats\Repository\PlayerRaceHistoryRepository;
use Jesperbeisner\Fwstats\Repository\PlayerRepository;
use Jesperbeisner\Fwstats\Service\PlaytimeService;

final readonly class ProfileControllerFactory implements FactoryInterface
{
    public function build(ContainerInterface $container, string $serviceId): ProfileController
    {
        /** @var PlayerRepository $playerRepository */
        $playerRepository = $container->get(PlayerRepository::class);

        /** @var PlaytimeService $playtimeService */
        $playtimeService = $container->get(PlaytimeService::class);

        /** @var PlayerNameHistoryRepository $playerNameHistoryRepository */
        $playerNameHistoryRepository = $container->get(PlayerNameHistoryRepository::class);

        /** @var PlayerRaceHistoryRepository $playerRaceHistoryRepository */
        $playerRaceHistoryRepository = $container->get(PlayerRaceHistoryRepository::class);

        /** @var PlayerProfessionHistoryRepository $playerProfessionHistoryRepository */
        $playerProfessionHistoryRepository = $container->get(PlayerProfessionHistoryRepository::class);

        return new ProfileController($playerRepository, $playtimeService, $playerNameHistoryRepository, $playerRaceHistoryRepository, $playerProfessionHistoryRepository);
    }
}
