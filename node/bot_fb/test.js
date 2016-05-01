// get walking directions from central park to the empire state building
var http = require("http");
    url = "http://maps.googleapis.com/maps/api/directions/json?origin=3321 Crystal Court, Miami, FL&destination=2980 McFarlane Rd, Miami, FL&sensor=false&mode=walking";

// get is a simple wrapper for request()
// which sets the http method to GET
var request = http.get(url, function (response) {
    // data is streamed in chunks from the server
    // so we have to handle the "data" event    
    var buffer = "", 
        data,
        route;

    response.on("data", function (chunk) {
        buffer += chunk;
    }); 

    response.on("end", function (err) {
        // finished transferring data
        // dump the raw data

        data = JSON.parse(buffer);
        route = data.routes[0];

        // extract the distance and time
        sayHi(route.legs[0].duration.text);
        console.log("Walking Distance: " + route.legs[0].distance.text);
        console.log("Time: " + route.legs[0].duration.text);
    }); 
}); 


function sayHi(you) {

	console.log("hello " + you);

}