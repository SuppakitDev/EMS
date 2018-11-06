@extends('Basetemplate.AdminLayout')
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world-continents.js"></script>
@section('content')
<style>
#container-map {
    height: 75%;
    /* min-width: auto; */
    max-width: 100%;
    /* margin: 0 auto; */
}
.loading {
    /* margin-top: 10em; */
    text-align: center;
    color:red;
}
</style>
                <div id="container-map"></div>
                
<script>

// Initiate the chart
$.getJSON('http://192.168.13.57/PointmapAPI', function (json) {
    var data = [];
    $.each(json, function () {
        this.z = this.population;
        data.push(this);
    });
Highcharts.mapChart('container-map', {
    legend:{
            enabled:false,
        },
         
chart: {
    map: 'custom/world-continents'
},

title: {
    text: 'Site Installation'
},

mapNavigation: {
    enabled: true
},

tooltip: {
    headerFormat: '',
    pointFormat: '<b>{point.name}</b><br>Lat: {point.lat}, Lon: {point.lon}'
},

series: [{
    // Use the gb-all map with no data as a basemap
    name: 'Basemap',
    borderColor: '#fff',
    nullColor: 'rgba(87 ,223 ,154, 0.85)',
    // nullColor: 'rgba(232 ,115 ,112)',
    showInLegend: false,
   
}, {
    name: 'Separators',
    type: 'mapline',
    nullColor: '#707070',
    showInLegend: false,
    enableMouseTracking: false
}, {
    // Specify points using lat/lon
    type: 'mappoint',
   
    color: Highcharts.getOptions().colors[8],
    data: data,
}]
});
console.log(data);

});

</script>
@endsection



