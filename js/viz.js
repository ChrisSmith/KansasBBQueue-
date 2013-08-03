$(document).ready(function() {
  nv.addGraph(function() {
    var chart = nv.models.lineWithFocusChart();

    chart.xAxis
        .axisLabel('Average wait time (min)')
        .tickFormat(d3.format(',f'));

    chart.yAxis
        .axisLabel('Time of day')
        .tickFormat(d3.format(',f'));

    chart.y2Axis
        .axisLabel('Time of day')
        .tickFormat(d3.format(',f'));

    d3.select('#chart svg')
        .datum(testData())
      .transition().duration(500)
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
 });

 function stream_layers(n, m, o) {
   if (arguments.length < 3) o = 0;
   function bump(a) {
     var x = 1 / (.1 + Math.random()),
         y = 2 * Math.random() - .5,
         z = 10 / (.1 + Math.random());
     for (var i = 0; i < m; i++) {
       var w = (i / m - y) * z;
       a[i] += x * Math.exp(-w * w);
     }
   }
   return d3.range(n).map(function() {
       var a = [], i;
       for (i = 0; i < m; i++) a[i] = o + o * Math.random();
       for (i = 0; i < 5; i++) bump(a);
       return a.map(stream_index);
     });
 }

 function stream_index(d, i) {
   return {x: i, y: Math.max(0, d)};
 }

 function testData() {
  return stream_layers(1,128,.9).map(function(data, i) {
    return {
      key: 'PS 111',
      values: data
    };
    });
  }
});
