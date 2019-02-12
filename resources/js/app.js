require("./bootstrap");
//window.Vue = require('vue');
import Vue from "vue";
import { VLazyImagePlugin } from "v-lazy-image";

import SmashGraph from "./components/SmashGraph";

Vue.use(VLazyImagePlugin);

Vue.component("smashgraph", SmashGraph);
Vue.component("smashgraphs", require("./components/SmashGraphs.vue").default);

const app = new Vue({
  el: "#app"
});
