clean:
	docker stop $$(docker ps -a -q)

up:
	docker-compose up -d --build
