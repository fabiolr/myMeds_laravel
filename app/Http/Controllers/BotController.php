<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BotController extends Controller
{
		public function callback(Request $request) {    

		    return $request->input("hub.challenge");

		    // if ($request["hub.verify_token"] == "Oquc1jcCyHOw3TQtZBOJYt3TcO") {

		    // 	return $request["hub.challenge"];
		    // }

		

		}
}
