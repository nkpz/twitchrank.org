**Smashstreams stores and graphs viewer counts for the top 25 users streaming Smash Ultimate on Twitch.**

Uses Vue, Docker, Docker Compose, Laravel, Twitch API, Redis for storing stream data, and Laravel Echo for updating graphs over a websocket.

The docker-compose configuration creates four containers:

web - Serves the application on port 80 using Apache

echo - Maintains a websocket connection with clients and provides updated stream data

cron - Schedules calls to the Twitch API to update stream data

redis - Stores stream data in memory

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
