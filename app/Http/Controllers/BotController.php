<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Med;

class BotController extends Controller
{
		public function callback(Request $request) {    

			

		    if ($request->input('hub_verify_token') == "Oquc1jcCyHOw3TQtZBOJYt3TcO") {

		   			 return $request->input('hub_challenge');
		    }

			return 'wrong token';

		}

		public function bot(Request $request) {    

				// find a way for the app to call this to register to receive msgs

				// curl -ik -X POST "https://graph.facebook.com/v2.6/me/subscribed_apps?access_token=CAAIsNqBHnnkBAA9ZAltIyh7U5VT4vSZAvVacgAZAUQ4Dq9WYsQ4AszueZBckN3jauQLka0KKPWwlQiC05MjeZAHS5gNsNnu1AvYFv4dgxU9wC4ZALlCeZAV7xNIqzywZBzinZA12iuxXDkBObZAr20eAM7YnOV8k5X4Jb2EIFJsBGs05TcHqiZCZCoRm0qogQsrGPPZCmac7ZC3pQitAZDZD"


		  		return view('bot.home');
		}

		public function incomingMessage(Request $request) {    

				// handle incoming messages
			
				
 			 $messaging_events = $request->input('req_body_entry[0]_messaging');


					$med = new Med;
				   	$med->name = $messaging_events; 
				   	$med->save();


  			// for (i = 0; i < count($messaging_events); i++) {
	    // 		$event = $request->input('req.body.entry[0].messaging[i]'); 
	    // 		$sender = $event->sender->id;
		   //  		if ($event->message) {
		   //   		 $text = $event->message->text;
		     		 	
					// $med = new Med;
				 //   	$med->name = $text; 
				 //   	$med->save();
				 //   }

		   // }

		   	// Handle a text message from this sender
   		
		});




}
