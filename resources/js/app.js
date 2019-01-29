require("./bootstrap");
//window.Vue = require('vue');
import Vue from "vue";

import VueApexCharts from "vue-apexcharts";

Vue.use(VueApexCharts);

Vue.component("apexchart", VueApexCharts);
Vue.component("smashgraphs", require("./components/SmashGraphs.vue").default);

const app = new Vue({
  el: "#app"
});
