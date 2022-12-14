<?php

declare(strict_types=1);

namespace Jesperbeisner\Fwstats\Process;

use Jesperbeisner\Fwstats\Action\CreateUserAction;
use Jesperbeisner\Fwstats\Exception\RuntimeException;
use Jesperbeisner\Fwstats\Interface\ProcessInterface;
use Jesperbeisner\Fwstats\Repository\MigrationRepository;
use Jesperbeisner\Fwstats\Stdlib\Request;

final readonly class SetupProcess implements ProcessInterface
{
    public function __construct(
        private string $databaseSetupFileName,
        private string $migrationsDirectory,
        private MigrationRepository $migrationRepository,
        private CreateUserAction $createUserAction,
    ) {
    }

    public function run(Request $request): void
    {
        if (is_file($this->databaseSetupFileName)) {
            return;
        }

        if (false === $migrationFiles = glob($this->migrationsDirectory . '/*.sql')) {
            throw new RuntimeException("An error occurred while 'globing' the migration files. :^)");
        }

        $this->migrationRepository->createMigrationsTable();

        foreach ($migrationFiles as $migrationFile) {
            if (false === $sql = file_get_contents($migrationFile)) {
                throw new RuntimeException(sprintf('Could not get sql content from file "%s".', $migrationFile));
            }

            $this->migrationRepository->executeMigration(basename($migrationFile), $sql);
        }

        $this->createUserAction->configure(['email' => 'admin@example.com', 'password' => 'Password12345']);
        $this->createUserAction->run();

        if (false === touch($this->databaseSetupFileName)) {
            throw new RuntimeException(sprintf('Could not create database setup file "%s".', $this->databaseSetupFileName));
        }
    }
}
