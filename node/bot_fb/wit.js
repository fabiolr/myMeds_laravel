// 'use strict';
var request = require('request');
require('dotenv').load();

const Wit = require('../../node_modules/node-wit').Wit;
// var http = require("http");
// url = "http://quotes.rest/qod.json?category=inspire";
// //url = "http://maps.googleapis.com/maps/api/directions/json?origin=3321 Crystal Court, Miami, FL&destination=2980 McFarlane Rd, Miami, FL&sensor=false&mode=walking";

// const token = "MD3ZNDB5MEGX7KLS7Y24FGQBJXBOFQWO"; //meds
const wit_token = process.env.WIT_TOKEN; //quotes
const context = {};



const actions = {
  say: (sessionId, msg, cb) => {
    cb();
  },
  merge: (context, entities, cb) => {
    const drug = firstEntityValue(entities, 'drug');
    if (drug) {
      context.drug = drug;
      console.log('the context is: ' + context.drug);

    }
    cb(context);
  },
  error: (sessionid, msg) => {
    console.log('Oops, I don\'t know what to do: ' + msg);
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
  'getUse': (context, cb) => {
     
     if (context.drug) {
      console.log('getting the use for: ' + context.drug);

     request('https://mymeds.miami/json/search/' + context.drug, function (error, response, body) {
              if (!error && response.statusCode == 200) {
                console.log('i got this from the mymeds server: ' + body)
                  try {
                    context.use = JSON.parse(body).uses[0].use;
                    console.log('then I parsed and got this use: ' + context.use)
                  } catch(error) {
                    console.log("i can't make sense of what the mymeds server replied, if he replied at all");
                    return cb(error);
                  }
                
                //context.use = 'something';
                return cb(context);
                }
      })
   } else {
    console.log('oops i dont know what drug he meant');
    return cb('error');
   }
  },
};


const firstEntityValue = (entities, entity) => {
  const val = entities && entities[entity] &&
    Array.isArray(entities[entity]) &&
    entities[entity].length > 0 &&
    entities[entity][0].value
  ;
  if (!val) {
    return null;
  }
  return typeof val === 'object' ? val.value : val;
};





const client = new Wit(wit_token, actions);
client.interactive();





