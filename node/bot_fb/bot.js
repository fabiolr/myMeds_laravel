
var token = "CAAIsNqBHnnkBAPzfc9krR6V6ZB0X81ZCr56nLakZAOD3wyTpTMhYBLZA7XePyMxRG8O3laI1DCuPkrGcSdWzzq3VZCGvzynBGQIUiAxk1Bpcp1z5jC0J4XmH2CwhnNaTZAYZCeXvZABFsZCSZAzZBv0rDT8sFBONYHFezZBeDsynLBbGebr9zRaxPrAKXPCVDZCYkDVlNjRJclAiiHQZDZD";
var wit = require('node-wit');
var ACCESS_TOKEN = "MD3ZNDB5MEGX7KLS7Y24FGQBJXBOFQWO";



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
    qs: {access_token:token},
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
app.listen();




