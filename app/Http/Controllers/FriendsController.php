<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Friendship;
use DateTime;

class FriendsController extends Controller 	{
    

    	public function index() {


			$user = Auth::user();
			$friends = $user->load('friendships.who');
			$friends = $friends->friendships;
			
			for ($x = 0; $x < count($friends); $x++) {
				
				$friends[$x]['medcount'] = $friends[$x]->who->meds->count();
					
			}

			return view('friends.home', compact('friends'));

			

				
		}


		public function show(User $friend) {


			$user = Auth::user();
    			
    		if (Friendship::where('user_id', $user->id)->where('friend_id', $friend->id)->count() > 0) {

			$hismeds = $friend->meds;
			$now = new DateTime();

			for ($x = 0; $x < count($hismeds); $x++) {
			
				$dateexp = new DateTime($hismeds[$x]->pivot->expiration);
				$interval = $now->diff($dateexp);
				$interval = $interval->format('%R%a days');
				$hismeds[$x]['interval'] = $interval;	
					
			}

			return view('friends.hismeds', compact('hismeds'), compact('friend'));

			} else {

				return("Not your friend");

			}	


		}
}
