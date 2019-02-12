require("dotenv").config();

const env = process.env;

require("laravel-echo-server").run({
  authHost: "http://web",
  authEndpoint: "/broadcasting/auth",
  clients: [],
  database: "redis",
  databaseConfig: {
    redis: {
      host: "redis"
    },
    sqlite: {
      databasePath: "/database/laravel-echo-server.sqlite"
    }
  },
  devMode: false,
  host: null,
  port: "2096",
  protocol: env.APP_ENV === 'production' ? "https" : 'http',
  sslCertPath: "keys/cert.pem",
  sslKeyPath: "keys/key.pem",
  sslCertChainPath: "",
  sslPassphrase: "",
  subscribers: {
    http: true,
    redis: true
  },
  apiOriginAllow: {
    allowCors: true,
    allowOrigin: "https://smashstreams.com,https://www.smashstreams.com,http://192.168.21.21",
    allowMethods: "GET, POST",
    allowHeaders: "Origin, Content-Type, X-Auth-Token, X-Requested-With, Accept, Authorization, X-CSRF-TOKEN, X-Socket-Id"
  }
});
