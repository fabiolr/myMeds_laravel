
require('dotenv').load();


// used for aeverything
var express = require('express');


// used for facebook
var bodyParser = require('body-parser');
var request = require('request');
var app = express();
var sender;

// used for wit
var request = require('request');
const Wit = require('node-wit').Wit;

// fb sessions

const sessions = {};

const findOrCreateSession = (fbid) => {
  var sessionId;
  // Let's see if we already have a session for the user fbid
  Object.keys(sessions).forEach(k => {
    if (sessions[k].fbid === fbid) {
      // Yep, got it!
      sessionId = k;
    }
  });
  if (!sessionId) {
    // No session found for user fbid, let's create a new one
    sessionId = new Date().toISOString();
    sessions[sessionId] = {fbid: fbid, context: {}};
  }
  return sessionId;
};



// WIT ACTIONS //

const actions = {
    say: (sessionId, message, cb) => {
    // Our bot has something to say!
    // Let's retrieve the Facebook user whose session belongs to
    const recipientId = sessions[sessionId].fbid;
    if (recipientId) {
      // Yay, we found our recipient!
      // Let's forward our bot response to her.
      // respondToUser(sender, 'you said ' + text);
      respondToUser(recipientId, message, (err, data) => {
        if (err) {
          console.log(
            'Oops! An error occurred while forwarding the response to',
            recipientId,
            ':',
            err
          );
        }

        // Let's give the wheel back to our bot
        cb();
      });
    } else {
      console.log('Oops! Couldn\'t find user for session:', sessionId);
      // Giving the wheel back to our bot
      cb();
    }
  },
  //   say: (sessionId, msg, cb) => {
  //   console.log("wit bot responded: " + msg);
  //   cb();
  // },
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
    'getUse': (context, cb) => {
     
     if (context.drug) {

     request('https://mymeds.miami/json/search/' + context.drug, function (error, response, body) {
              if (!error && response.statusCode == 200) {
                context.use = JSON.parse(body).uses[0].use;
                return cb(context);
                }
      })
   } else {
    console.log('oops i dont know what drug he meant');

   }
  },
};



/////// END OF WIT ACTIONS  


// WEBSERVER SETUP 
app.set('port', (process.env.PORT || 5000));
app.listen(app.get('port'));
app.use(bodyParser.json());

// LISTE TO FACEBOOK 
app.get('/bot/facebook', function(req, res) {
  console.log(req);

  if (
    req.param('hub.mode') == 'subscribe' &&
    req.param('hub.verify_token') == 'fhnjfdshf89yr3jldkejy3ecejfy32ondkfh03'
    ) {
    res.send(req.param('hub.challenge'));
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
    const sessionId = findOrCreateSession(sender);

    if (event.message && event.message.text) {
      msg = event.message.text;
      
      console.log("received message from facebook: " + msg);

            client.runActions(
            sessionId, // the user's current session
            msg, // the user's message 
            sessions[sessionId].context, // the user's current session state
            (error, context) => {
              if (error) {
                console.log('Oops! Got an error from Wit:', error);
              } else {
                // Our bot did everything it has to do.
                // Now it's waiting for further messages to proceed.
                console.log('Waiting for futher messages.');

                // Based on the session state, you might want to reset the session.
                // This depends heavily on the business logic of your bot.
                // Example:
                // if (context['done']) {
                //   delete sessions[sessionId];
                // }

                // Updating the user's current session state
                sessions[sessionId].context = context;
              }
            }
          );

  
      //    parrot mode:
      //  respondToUser(sender, 'you said ' + text);


    }
  }

  res.sendStatus(200);

});


// function to responde to user on facebook

function respondToUser(sender, msg, cb) {

    console.log('sending ' + msg);

  messageData = {
    text:msg
  }
  request({
    url: 'https://graph.facebook.com/v2.6/me/messages',
    qs: {access_token:process.env.FB_TOKEN},
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
  return cb();
}

// function to get entity from what user said
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





app.listen();

// wit method to deal with message
const client = new Wit(process.env.WIT_TOKEN, actions);




