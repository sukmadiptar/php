
const CHART = document.getElementById("lineChart");
console.log(CHART);

let lineChart = new lineChart(CHART, {
	type: 'bar',
	data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Employee Gender',
            fill: false,
            lineTension: 0.1,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            borderCapStyle: 'butt',
            borderDash:[],
            borderDashOffset:0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75, 192, 192, 1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
            pointHoverBorderColor: "rgba(220, 220, 220, 1)",
            pointHoverBorderWidth: 2,
            pintRadius: 1,
            pointHitRadius: 10,
            data: [5, 4, 0]

        }]
    }
	
});