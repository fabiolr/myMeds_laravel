<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BotController extends Controller
{
		public function callback(Request $request) {    

			

		    if ($request->input('hub_verify_token') == "Oquc1jcCyHOw3TQtZBOJYt3TcO") {

		   			 return $request->input('hub_challenge');
		    }

		

		}
}
