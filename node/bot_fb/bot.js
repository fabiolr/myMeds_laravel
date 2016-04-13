
var bodyParser = require('body-parser');
var express = require('express');
var app = express();

app.set('port', (process.env.PORT || 5000));
app.listen(app.get('port'));

app.use(bodyParser.json());

app.get('/', function(req, res) {
  console.log(req);
  res.send('It works!');
});

app.get(['/facebook', '/instagram'], function(req, res) {
  if (
    req.param('hub.mode') == 'subscribe' &&
    req.param('hub.verify_token') == 'CAAIsNqBHnnkBAJrLBXp4mo9X2fCgDGyO1iu0xFaaXlozZBZB0IHioR1XFLXxClkuHTnUF28CtAdI39gkMr1ijnGfGbZAsZCulPZBFb5JvYgo94qJzaRaIwbtgLdMKWUh0LysXMYR8ccGlCswinZAJ94CEXfd88p7j2fE7JFXqk4JK0SCvoJTOVN1BVQ9zd5cDJ1HKavBE1BQZDZD'
  ) {
    res.send(req.param('hub.challenge'));
  } else {
    res.sendStatus(400);
  }
});

app.post('/facebook', function(req, res) {
  console.log('Facebook request body:');
  console.log(req.body);
  // Process the Facebook updates here
  res.sendStatus(200);
});

app.post('/instagram', function(req, res) {
  console.log('Instagram request body:');
  console.log(req.body);
  // Process the Instagram updates here
  res.sendStatus(200);
});

app.listen();
