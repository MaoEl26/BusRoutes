

var coord ;
var lat = "";
var lng = "";
var routeArray;
var waypoints =[];
var mymap = L.map('mapid', {zoomControl:false} ).setView([9.934739, -84.087502], 12);
L.control.zoom({
    position:'topright'
}).addTo(mymap);

L.tileLayer('http://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	maxZoom: 18,
	id: 'mapbox.streets',
	accessToken: 'pk.eyJ1IjoidmFyZGllOTUiLCJhIjoiY2syODltdHZ1MG5hcjNobzF4aWswcGR2bCJ9.-b-fXBLHqS5U7hW0TjdGCg',
	serviceurl:"/router.project-osrm.org/viaroute"
    
}).addTo(mymap);

waypoints.push(L.latLng(9.934739, -84.087502));
waypoints.push(L.latLng(9.934739, -84.087502));
var routeControl = L.Routing.control({
	waypoints,
	routeWhileDragging: true,
	show: false,
	geocoder: L.Control.Geocoder.nominatim()
	

  }).addTo(mymap);

  function createButton(label, container) {
    var btn = L.DomUtil.create('button', '', container);
    btn.setAttribute('type', 'button');
    btn.innerHTML = label;
    return btn;
}

mymap.on('click', function(e) {      
	
	     
});

function getCoordinates(){
	lat = "";
	lng = "";
	routeArray = new Array();
	routeArray = routeControl.getWaypoints();
	for(var i =0; i <routeArray.length; i++ ){
		lat = lat + routeArray[i].latLng.lat + ", ";
		lng = lng +routeArray[i].latLng.lng + ",";
		

	}
	document.getElementById("lat").value = lat; 
	document.getElementById("lng").value = lng;
	
	

}

function printCoordinates(){
	var lat = document.getElementById("lat").value;
	var lng = document.getElementById("lng").value;
	var latArray = lat.split(",");
	var lngArray = lng.split(",");
	waypoints= [];
	route='';
	for (var i=0; i < latArray.length -1  ;i++){
		waypoints.push(L.latLng(latArray[i],lngArray[i]));
	}
	
	routeControl = L.Routing.control({
		waypoints
		,
	 routeWhileDragging: true,
	 show: false,
	 geocoder: L.Control.Geocoder.nominatim()
	 }).addTo(mymap);
	

}

	

	




