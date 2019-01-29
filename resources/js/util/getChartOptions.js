import { format } from "date-fns";

export default bounds => {
    return {
        chart: {
            animations: {
                enabled: false
            },
            height: 150,
            zoom: {
                enabled: false
            },
            type: "line",
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        grid: {
            borderColor: "#eee"
        },
        markers: {
            radius: 1,
            strokeWidth: 0,
            size: 1,
            colors: "#fff",
            fillOpacity: 0.3
        },
        stroke: {
            curve: "straight",
            width: 2
        },
        tooltip: {
            x: {
                format: "hh:mm"
            }
        },
        xaxis: {
            labels: {
                formatter: val => {
                    const date = new Date(val);
                    return `${format(date, "hh:mm")}`;
                },
                offsetX: -4
            },
            type: "datetime"
        },
        yaxis: {
            min: 0
        }
    };
};
