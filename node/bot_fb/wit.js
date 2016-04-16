// 'use strict';
var request = require('request');
const Wit = require('../../node_modules/node-wit').Wit;
// var http = require("http");
// url = "http://quotes.rest/qod.json?category=inspire";
// //url = "http://maps.googleapis.com/maps/api/directions/json?origin=3321 Crystal Court, Miami, FL&destination=2980 McFarlane Rd, Miami, FL&sensor=false&mode=walking";

// const token = "MD3ZNDB5MEGX7KLS7Y24FGQBJXBOFQWO"; //meds
const wit_token = "YTBUDDOE7QONDWDBW4PBDTHXXR3JS4BV"; //quotes

const actions = {
  say: (sessionId, msg, cb) => {
    console.log(msg);
    cb();
  },
  merge: (context, entities, cb) => {
    cb(context);
  },
  error: (sessionid, msg) => {
    console.log('Oops, I don\'t know what to do.');
  },
  'getUse': (context, cb) => {
    console.log(context.drug);
    context.use = "headache";
    cb(context);
  },  
  'getQuote': (context, cb) => {
          
     request('http://quotes.rest/qod.json?category=inspire', function (error, response, body) {
              if (!error && response.statusCode == 200) {
                data = body;
                context.selected = JSON.parse(body).contents.quotes[0].quote;
                return cb(context);
                }
      })
  },
};


const client = new Wit(wit_token, actions);
// client.interactive();


client.message('get me a quote', (error, data) => {
  if (error) {
    console.log('Oops! Got an error: ' + error);
  } else {
    console.log('Yay, got Wit.ai response: ' + JSON.stringify(data));
  }
});
  


