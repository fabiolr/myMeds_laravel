'use strict';

const fb_token = "CAAIsNqBHnnkBAPzfc9krR6V6ZB0X81ZCr56nLakZAOD3wyTpTMhYBLZA7XePyMxRG8O3laI1DCuPkrGcSdWzzq3VZCGvzynBGQIUiAxk1Bpcp1z5jC0J4XmH2CwhnNaTZAYZCeXvZABFsZCSZAzZBv0rDT8sFBONYHFezZBeDsynLBbGebr9zRaxPrAKXPCVDZCYkDVlNjRJclAiiHQZDZD";
const wit_token = "MD3ZNDB5MEGX7KLS7Y24FGQBJXBOFQWO";
const Wit = require('node-wit').Wit;
const Logger = require('node-wit').Logger;
const levels = require('node-wit').logLevels;
const logger = new Logger(levels.DEBUG);
var context = {};
var sessions = {};


const allJokes = {
  chuck: [
    'Chuck Norris counted to infinity - twice.',
    'Death once had a near-Chuck Norris experience.',
  ],
  tech: [
    'Did you hear about the two antennas that got married? The ceremony was long and boring, but the reception was great!',
    'Why do geeks mistake Halloween and Christmas? Because Oct 31 === Dec 25.',
  ],
  default: [
    'Why was the Math book sad? Because it had so many problems.',
  ],
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



const actions = {
  say: (sessionId, msg, cb) => {
    console.log(msg);
    cb();
  },
  merge: (context, entities, cb) => {
    delete context.joke;
    const category = firstEntityValue(entities, 'category');
    if (category) {
      context.cat = category;
    }
    const sentiment = firstEntityValue(entities, 'sentiment');
    if (sentiment) {
      context.ack = sentiment === 'positive' ? 'Glad you liked it.' : 'Hmm.';
    } else {
      delete context.ack;
    }
    cb(context);
  },
  error: (sessionId, msg) => {
    console.log('Oops, I don\'t know what to do.');
  },
  'select-joke': (context, cb) => {
    const jokes = allJokes[context.cat || 'default'];
    context.joke = jokes[Math.floor(Math.random() * jokes.length)];
    cb(context);
  },
};

var bodyParser = require('body-parser');
var express = require('express');
var request = require('request');
var app = express();

app.set('port', (process.env.PORT || 5000));
app.listen(app.get('port'));

app.use(bodyParser.json());

app.get('/bot/facebook', function(req, res) {
  console.log(req);

  if (
    req.params('hub.mode') == 'subscribe' &&
    req.params('hub.verify_token') == 'fhnjfdshf89yr3jldkejy3ecejfy32ondkfh03'
    ) {
    res.send(req.params('hub.challenge'));
  } else {
    res.sendStatus(400);
  }

});

app.post('/bot/facebook', function(req, res) {
  // console.log('Facebook request body:');

  console.log(req.body);

  // Process the Facebook updates here

   messaging_events = req.body.entry[0].messaging;

	//console.log(JSON.stringify(messaging_events));

  for (i = 0; i < messaging_events.length; i++) {
    event = req.body.entry[0].messaging[i];
    sender = event.sender.id;
    
    if (event.message && event.message.text) {
      text = event.message.text;
      
     	// console.log(text);

	client.message(text, (error, data) => {
  if (error) {
    console.log('Oops! Got an error: ' + error);
  } else {
    console.log('Yay, got Wit.ai response: ' + JSON.stringify(data));
  }
});



	//respondToUser(sender, res);


      	// Handle a text message from this sender
    	// respondToUser(sender, "Text received, echo: "+ text.substring(0, 200));

     
    }
  }

  res.sendStatus(200);

});

// app.post('/bot/instagram', function(req, res) {
//   console.log('Instagram request body:');
//   console.log(req.body);
//   // Process the Instagram updates here
//   res.sendStatus(200);
// });


function respondToUser(sender, msg) {

	  console.log('sending ' + msg);

  messageData = {
    text:msg
  }
  request({
    url: 'https://graph.facebook.com/v2.6/me/messages',
    qs: {access_token:fb_token},
    method: 'POST',
    json: {
      recipient: {id:sender},
      message: messageData,
    }
  }, function(error, response, body) {
    if (error) {
      console.log('Error sending message: ', error);
    } else if (response.body.error) {
      console.log('Error: ', response.body.error);
    }
  });
}


const client = new Wit(wit_token, actions);

app.listen();




