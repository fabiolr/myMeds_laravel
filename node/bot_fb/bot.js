
var token = "CAAIsNqBHnnkBAPzfc9krR6V6ZB0X81ZCr56nLakZAOD3wyTpTMhYBLZA7XePyMxRG8O3laI1DCuPkrGcSdWzzq3VZCGvzynBGQIUiAxk1Bpcp1z5jC0J4XmH2CwhnNaTZAYZCeXvZABFsZCSZAzZBv0rDT8sFBONYHFezZBeDsynLBbGebr9zRaxPrAKXPCVDZCYkDVlNjRJclAiiHQZDZD";


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
    
    if (event.message && event.message.text) {
      text = event.message.text;
      
     	console.log(text);

      respondToUser(sender, 'you said ' + text);
    }
  }

  res.sendStatus(200);

});


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




