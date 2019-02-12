### Live
https://www.smashstreams.com/

**Smashstreams stores and graphs viewer counts for the top 25 users streaming Smash Ultimate on Twitch.**

Uses Vue, Docker, Docker Compose, Laravel, Twitch API, Redis for storing stream data, and Laravel Echo for updating graphs over a websocket.

The docker-compose configuration creates four containers:

web - Serves the application on port 80 using Apache

echo - Websocket server that provides updated stream data to clients. Uses port 2096

cron - Schedules calls to the Twitch API to update stream data

redis - Stores stream data in memory

### Build requirements
docker

docker-compose

### Build
`docker-compose up -d`

`mv .env.example .env`

`npm run keygen`

*Use the output to set APP_KEY in .env*

Enter your Twitch API credentials in .env

### Run
`docker-compose up -d`

App runs on port 80
