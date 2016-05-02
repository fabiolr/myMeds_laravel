<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Med;
use Auth;
use DB;
use App\User;

class DashController extends Controller {

	public function index() {

		$dash = new \stdClass();
		$user = Auth::user();
		$meds = Med::all();
		$user->load('meds.uses');
		$user->load('friendships');
		$dash->medc = $meds->count();
		$dash->mymedc = $user->meds->count();
		$dash->friends = [];
		$dash->unsansweredRequests = [];

		// determining # two-way friendships
		$requestsMade = $user->friendships->all();
		$requestsReceived = DB::table('friendships')->where('friend_id', '=', $user->id)->get();
	

		foreach ($requestsMade as $requestMade) {
				foreach ($requestsReceived as $requestReceived) {
					if ($requestMade->friend_id == $requestReceived->user_id) {
					array_push($dash->friends, $requestMade);
					}
				}
		}


		foreach ($requestsReceived as $requestReceived) {
				$count=0;

				foreach ($requestsMade as $requestMade) {
					if ($requestReceived->user_id == $requestMade->friend_id) {
						$count++;
					}
				}

					if ($count == 0) {


						array_push($dash->unsansweredRequests, $requestReceived);

					}
				
		}

		
			for ($x = 0; $x < count($dash->unsansweredRequests); $x++) {
			
				$dash->unsansweredRequests[$x]->user = User::find($dash->unsansweredRequests[$x]->user_id);

			}

		return view('pages.dash', compact('dash'));
	}

}
