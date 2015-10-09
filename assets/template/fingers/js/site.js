function setSiteURL() { 

	var server = window.location.host;

	window.site = "http://"+server+"/"; 

} 



$(document).ready( function() {

	setSiteURL();

});