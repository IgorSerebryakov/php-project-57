start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	php artisan db:seed
	npm ci
	npm run build
	make ide-helper

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

lint:
	composer phpcs

lint-fix:
	composer phpcbf

seed-TaskStatus:
	php artisan db:seed --class=TaskStatusSeeder

seed-User:
	php artisan db:seed --class=UserSeeder

seed-Label:
	php artisan db:seed --class=LabelSeeder

seed-Task:
	php artisan db:seed --class=TaskSeeder

seed: seed-TaskStatus seed-User seed-Label seed-Task
