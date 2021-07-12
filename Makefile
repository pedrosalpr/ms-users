CONTAINER_NAME=ms_users_app

docker-up:
	docker network create microservice_external || true
	docker-compose up -d

docker-down:
	docker-compose down

docker-bash:
	docker exec -it $(CONTAINER_NAME) /bin/sh

docker-install:
	docker exec $(CONTAINER_NAME) composer install --no-interaction --no-scripts
	make docker-migrate

docker-migrate:
	docker exec $(CONTAINER_NAME) php artisan migrate

docker-test:
	make docker-up
	make docker-clear
	docker exec $(CONTAINER_NAME) composer test

docker-clear:
	docker exec $(CONTAINER_NAME) sh -c "php artisan optimize:clear && php artisan debugbar:clear"

docker-phplint-cs:
	docker exec $(CONTAINER_NAME) composer phplint-cs

docker-phplint-md:
	docker exec $(CONTAINER_NAME) composer phplint-md

docker-phpreport:
	docker exec $(CONTAINER_NAME) composer php-report

