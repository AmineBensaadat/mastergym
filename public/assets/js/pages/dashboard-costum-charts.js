$(document).ready(function(){
  // get colors array from the string
function getChartColorsArray(chartId) {
if (document.getElementById(chartId) !== null) {
var colors = document.getElementById(chartId).getAttribute("data-colors");

if (colors) {
colors = JSON.parse(colors);
return colors.map(function (value) {
var newValue = value.replace(" ", "");

if (newValue.indexOf(",") === -1) {
  var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
  if (color) return color;else return newValue;
  ;
} else {
  var val = value.split(',');

  if (val.length == 2) {
    var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
    rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
    return rgbaColor;
  } else {
    return newValue;
  }
}
});
} else {
console.warn('data-colors atributes not found on', chartId);
}
}
} // world map with line & markers
var chartDonutBasicColors = getChartColorsArray("store-visits-source");

if (chartDonutBasicColors) {
$.ajax({
type:'POST',
url:'../members/getStatisticData',
data: {'_token' : '{{ csrf_token() }}'},
success:function(data) {
//$("#msg").html(data.msg);
$( "#all_members" ).attr( "data-target", 129);
console.log(data);
}
});
var options = {
series: [44, 0, 60],
labels: ["MONTHLY JOININGS", "PENDING PAYMENTS", "EXPIRED"],
chart: {
height: 333,
type: "donut"
},
legend: {
position: "bottom"
},
stroke: {
show: false
},
dataLabels: {
dropShadow: {
enabled: false
}
},
colors: chartDonutBasicColors
};
var chart = new ApexCharts(document.querySelector("#store-visits-source"), options);
chart.render();
} // world map with markers
});

