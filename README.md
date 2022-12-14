# fwstats

## Setup

### Local

```bash
# Start Docker Containers
docker-compose up -d

# Install composer packages
docker-compose exec php composer install

# Load migrations
docker-compose exec php php bin/console.php app:database-migration

# Load test data
docker-compose exec php php bin/console.php app:database-fixture

# Visit http://localhost:8080

# Test-Account-Mail: admin@example.com
# Test-Account-Password: Password12345
```

### Prod

```bash
# Create prod config and change needed values
cp ./.env.local.php.dist ./.env.local.php

# Docker
docker-compose -f docker-compose.prod.yml up -d --build

# Install composer packages
docker-compose exec php composer install --no-dev --optimize-autoloader --no-interaction

# Load migrations
docker-compose exec php php bin/console.php app:database-migration

# Run one cronjob for everything every 5 minutes
*/5 * * * * docker exec fwstats-php-prod php bin/console.php app:run > /dev/null 2>&1 
```
