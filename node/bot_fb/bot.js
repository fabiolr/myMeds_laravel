
var bodyParser = require('body-parser');
var express = require('express');
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
  console.log('Facebook request body:');
  console.log(req.body);
  


  // Process the Facebook updates here
  res.sendStatus(200);
});

app.post('/bot/instagram', function(req, res) {
  console.log('Instagram request body:');
  console.log(req.body);
  // Process the Instagram updates here
  res.sendStatus(200);
});

app.post('/bot/facebook/', function (req, res) {
	console.log('got a request for facebook:');
	console.log(req.body);

  messaging_events = req.body.entry[0].messaging;
  for (i = 0; i < messaging_events.length; i++) {
    event = req.body.entry[0].messaging[i];
    sender = event.sender.id;
    if (event.message && event.message.text) {
      text = event.message.text;
      // Handle a text message from this sender
    }
  }
  res.sendStatus(200);
});




app.listen();
