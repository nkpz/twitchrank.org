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
  devMode: true,
  host: null,
  port: "8234",
  protocol: env.APP_ENV === "production" ? "https" : "http",
  socketio: {},
  sslCertPath: "keys/cert.pem",
  sslKeyPath: "keys/key.pem",
  sslCertChainPath: "",
  sslPassphrase: "",
  subscribers: {
    http: true,
    redis: true
  },
  apiOriginAllow: {
    allowCors: false,
    allowOrigin: "",
    allowMethods: "",
    allowHeaders: ""
  }
});
