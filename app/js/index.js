// Compile our scss
// This 'includes' the SCSS index file which webpack then reads and
// compiles into the necessary css files
require('../scss/index.scss');


$(document).ready( function(){
    if ($('#curve_chart').length > 0){
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    }
});

$(window).resize(function(){
    drawChart();
});
console.log('yo');

function drawChart() {

    var header = [["Day", "Water"]];

    var dataImport = JSON.parse(document.getElementById('myArray').value);

    var dataaa = header.concat(dataImport);
    dataImport.reduce(function (a, b) {
        return {x: a.x + b.x}; // returns object with property x
    })

    dataImport.reduce(function(prev, curr, index) {
        return prev + curr;
    });

    console.log(dataImport);

    var data = new google.visualization.arrayToDataTable(dataaa);

    var options = {
        title: 'Water History (7 days)',
        // curveType: 'function',
        vAxis: {viewWindow: {min:0} },
        legend: { position: 'bottom' },
        height: 350,
        backgroundColor: 'white',
        series: {
            0: { color: '#05DAC6' }},
        hAxis : {
            textStyle : {
                fontSize: 12 // or the number you want
            }

        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}
