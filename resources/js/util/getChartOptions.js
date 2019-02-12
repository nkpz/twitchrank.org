import { format } from "date-fns";

export default bounds => {
  return {
    animation: {
      duration: 0 // general animation time
    },
    hover: {
      animationDuration: 0 // duration of animations when hovering an item
    },
    legend: {
      display: false
    },
    responsiveAnimationDuration: 0, // animation duration after a resize
    scales: {
      xAxes: [
        {
          type: "time",
          time: {
            min: bounds.xmin,
            max: bounds.xmax,
            unit: "minute",
            unitStepSize: 15
          }
        }
      ],
      yAxes: [
        {
          ticks: {
            precision: 0,
            maxTicksLimit: 5,
            beginAtZero: true
          }
        }
      ]
    }
  };
};
