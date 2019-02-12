### Demo
http://www.smashstreams.com/

### Requirements
docker

docker-compose

### Build
`mv .env.example .env`

`php artisan key:generate`

*If PHP is not installed on the host, you run php commands from the web container using `npm run bash`*

Enter your Twitch API credentials in .env

### Run
`docker-compose up -d`

App runs on port 80
