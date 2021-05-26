################################################################################
################################################################################

# PROXIES (to Docker-containers commands)
alias php="docker-compose run --rm php-cli"
alias node-cli="docker-compose run --rm frontend-node-cli"
alias composer="docker-compose run --rm php-cli composer"
alias app="docker-compose run --rm php-cli composer app"
alias linter="docker-compose run --rm php-cli composer lint"
alias lint="linter && phpcs"
alias test-e2e="api-fixtures && cucumber-clear && cucumber-e2e"
alias api-test="docker-compose run --rm php-cli composer test"

# Symfony
alias console="docker-compose run --rm php-fpm php ./bin/console"

phpunit() {
  EXECUTE="./vendor/bin/phpunit"
  if [ -f "./bin/phpunit" ]; then
      EXECUTE="./bin/phpunit"
  fi
  docker-compose run --rm php-cli ${EXECUTE} "$@"
}

# Laravel
alias artisan="docker-compose run --rm php-fpm php artisan"

# Yii2
alias yii="docker-compose run --rm php-fpm php yii"

################################################################################
################################################################################

# MAINTENANCE

alias permissions="docker run --rm -v /$PWD/api://var/www -w //var/www alpine chmod 777 var/cache var/log/cli var/log/fpm-fcgi"


################################################################################
#Doctrine

alias app-validate="app orm:validate-schema"
alias app-diff="app migrations:diff"
alias app-migrate="app migrations:migrate"

################################################################################
################################################################################

alias build-gateway="docker --log-level=debug build --pull --file=gateway/docker/production/nginx/Dockerfile --tag=${REGISTRY}/ts-gateway:${IMAGE_TAG} gateway/docker/production/nginx"

alias build-frontend="docker --log-level=debug build --pull --file=frontend/docker/production/nginx/Dockerfile --tag=${REGISTRY}/ts-frontend:${IMAGE_TAG} frontend"

alias build-api-nginx="docker --log-level=debug build --pull --file=api/docker/production/nginx/Dockerfile --tag=${REGISTRY}/ts-api:${IMAGE_TAG} api"

alias build-api-php-fpm="docker --log-level=debug build --pull --file=api/docker/production/php-fpm/Dockerfile --tag=${REGISTRY}/ts-api-php-fpm:${IMAGE_TAG} api"


################################################################################
################################################################################

## DOCKER ENVIRONMENT ALIASES

alias env-up="docker-compose up -d"
alias env-stop="docker-compose stop"
alias env-down="docker-compose down --remove-orphans"
alias env-restart="env-stop && env-up"
alias env-build="docker-compose build --pull"
alias env-pull="docker-compose pull"
alias env-rebuild="env-build && env-restart && permissions"
alias env-logs="docker-compose logs"
alias env-down-clear="docker-compose down -v --remove-orphans"

##################################################################################
# API DOCKER
alias api-clear="docker run --rm -v /$PWD/api://var/www -w "//var/www" alpine sh -c 'rm -rf var/log/cli/* var/log/fpm-fcgi/* var/cache/*'"
alias api-composer-install="docker-compose run --rm php-cli composer install"
alias api-wait-db="docker-compose run --rm php-cli wait-for-it postgres:5432 -t 30"
alias api-migrations="docker-compose run --rm php-cli composer app migrations:migrate -- --no-interaction"
alias api-fixtures="docker-compose run --rm php-cli composer app fixtures:load"


##################################################################################
# FRONTEND DOCKER

alias frontend-clear="docker run --rm -v /$PWD/frontend://var/www -w "//var/www" alpine sh -c 'rm -rf .ready build'"
alias frontend-init="frontend-yarn-install"
alias frontend-yarn-install="docker-compose run --rm frontend-node-cli yarn install"
alias frontend-ready="docker run --rm -v /$PWD/frontend://var/www -w //var/www alpine touch .ready"
alias frontend-test="docker-compose run --rm frontend-node-cli yarn test --watchAll=false"
alias frontend-eslint="node-cli yarn lint"
alias frontend-stylelint="node-cli yarn stylelint"
alias frontend-lint="frontend-eslint && frontend-stylelint"

##################################################################################

alias cucumber="docker-compose run --rm cucumber-node-cli"
alias cucumber-clear="docker run --rm -v /$PWD/cucumber://var/www -w "//var/www" alpine sh -c 'rm -rf var/*'"
alias cucumber-e2e="docker-compose run --rm cucumber-node-cli yarn e2e"


env-init() {
  env-pull
  env-build
  env-restart
  permissions
}

api-init() {
  permissions
  api-composer-install
  api-wait-db
  api-migrations
}

make-init() {
  env-down-clear
  api-clear
  frontend-clear
  env-pull
  env-build
  env-up
  api-init
  frontend-init
  frontend-ready
}