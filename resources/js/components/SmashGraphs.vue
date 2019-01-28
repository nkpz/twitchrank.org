<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body">
                        <div v-for="(stream, rank) in stats" :key="stream.id">
                            {{`${rank+1}. ${stream.name} - ${stream.data[0].data[stream.data[0].data.length-1][1]} Viewers`}}
                            <apexchart type=line height=150 :options="chartOptions" :series="stream.data" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import getChartOptions from '../util/getChartOptions';

    // Number of data points we store in Redis before popping
    const MAX_POINTS = 240;

    const formatData = (streams) => {
        return streams.map((stream) => ({
            name: stream.name,
            id: stream.id,
            data: [{
                name: 'Viewers',
                data: stream.stats
            }]
        }));
    };

    const getBounds = (streams) => {
        let longestRecord = [];
        
        streams.some((stream) => {
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
            xmax: longestRecord[longestRecord.length - 1][0],
        };
    };

    export default {
        props: ['streamdata'],
        mounted() {
            window.Echo.channel('stats-event')
                .listen('.SmashStreams.StatsUpdate', (e) => {
                    this.streamData = e.stats;
                    this.bounds = getBounds(e.stats);
                    console.log("wowoowo", this.bounds);
                });
        },
        computed: {
            stats() {
                return formatData(this.streamData);
            },
            chartOptions() {
                return getChartOptions(this.bounds);
            },
        },
        data() {
            const streamData = JSON.parse(this.streamdata);
            const bounds = getBounds(streamData);

            return {
                streamData,
                bounds,
            }
        }
    }
</script>
