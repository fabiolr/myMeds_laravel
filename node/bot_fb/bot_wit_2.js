
var wit = require('node-wit');
 
var ACCESS_TOKEN = "MD3ZNDB5MEGX7KLS7Y24FGQBJXBOFQWO";
wit.captureTextIntent(ACCESS_TOKEN, "What's the weather in Melbourne?", function (err, res) {
    console.log("Response from Wit for text input: ");
    if (err) console.log("Error: ", err);
    console.log(JSON.stringify(res, null, " "));
});
