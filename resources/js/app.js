require("./bootstrap");
//window.Vue = require('vue');
import Vue from "vue";
import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload, {
  observer: true,
  observerOptions: {
    rootMargin: '180px',
    threshold: 0.5
  },
});

import SmashGraph from "./components/SmashGraph";

Vue.component("smashgraph", SmashGraph);
Vue.component("smashgraphs", require("./components/SmashGraphs.vue").default);

const app = new Vue({
  el: "#app"
});
