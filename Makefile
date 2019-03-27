db_data: db_migration db_fixtures

db_install: db_create db_migration db_fixtures

db_restart: db_drop db_create db_migration db_fixtures

db_drop:
	php bin/console doctrine:database:drop --force;

db_create:
	php bin/console doctrine:database:create;

db_migration_create:
	php bin/console make:migration;

db_migration:
	php bin/console doctrine:migrations:migrate;

db_fixtures:
	php bin/console doctrine:fixtures:load;

server_start:
	php bin/console server:start;

server_stop:
	php bin/console server:stop;

live_test_rm:
	rm -rf public/crawler-test/*

assetic:
	php bin/console assets:install --symlink;