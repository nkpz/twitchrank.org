<template>
  <div>
    <div v-for="(stream, rank) in stats" :key="stream.id">
      <div class="smashstreams__graph">
        <div class="row">
          <div class="col-md-8">
            <span class="smashstreams__graph-label">
              <span>{{rank+1}}.</span>
              <a :href="stream.url">{{stream.name}}</a>
              <span>- {{getViewers(stream)}} Viewers</span>
            </span>
            <smashgraph :options="chartOptions" :chartData="stream.data" :height="60"/>
          </div>
          <div class="col-md-4">
            <img
              v-on:click="showStream(stream.name)"
              class="smashstreams__thumbnail"
              v-lazy="stream.thumbnail"
            />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div v-if="activeStream === stream.name" id="twitch-embed"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import getChartOptions from "../util/getChartOptions";

// Number of data points we store in Redis before shifting
const MAX_POINTS = 240;

const formatData = streams => {
  return streams.map(stream => ({
    thumbnail: stream.thumbnail,
    url: stream.url,
    name: stream.name,
    id: stream.id,
    data: {
      labels: stream.stats.map(stat => stat[0]),
      datasets: [
        {
          label: "Viewers",
          backgroundColor: "#53b0fd",
          borderColor: "#53b0fd",
          borderWidth: 2,
          fill: false,
          lineTension: 0,
          spanGaps: false,
          pointRadius: 2,
          pointBorderWidth: 0,
          pointStyle: "line",
          data: stream.stats.map(stat => stat[1])
        }
      ]
    }
  }));
};

const getBounds = streams => {
  let longestRecord = [];

  streams.some(stream => {
    if (stream.stats.length > longestRecord.length) {
      longestRecord = stream.stats;

      if (stream.stats.length === MAX_POINTS) {
        return true;
      }
    }
    return false;
  });

  return {
    xmin: longestRecord[0][0],
    xmax: longestRecord[longestRecord.length - 1][0]
  };
};

export default {
  props: ["streamdata"],
  mounted() {
    window.Echo.channel("stats-event").listen(
      ".SmashStreams.StatsUpdate",
      e => {
        this.streamData = e.stats;
        this.bounds = getBounds(e.stats);
      }
    );
  },
  methods: {
    showStream(streamName) {
      this.activeStream = this.activeStream === streamName ? null : streamName;
      this.$nextTick(() => {
        if (this.activeStream !== null) {
          new Twitch.Embed("twitch-embed", {
            width: Math.min(window.innerWidth, 854),
            height: 320,
            channel: streamName,
            theme: 'dark',
          });
        }
      });
    },
    getViewers: stream =>
      stream.data.datasets[0].data[stream.data.datasets[0].data.length - 1]
  },
  computed: {
    stats() {
      return formatData(this.streamData);
    },
    chartOptions() {
      return getChartOptions(this.bounds);
    }
  },
  data() {
    const streamData = JSON.parse(this.streamdata);
    const bounds = getBounds(streamData);

    return {
      streamData,
      bounds,
      activeStream: null
    };
  }
};
</script>
