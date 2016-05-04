<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Friendship;
use DateTime;
use Mail;


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

			$friend->added = (Friendship::where('user_id', $user->id)->where('friend_id', $friend->id)->count() > 0);
			$friend->beenAdded = (Friendship::where('user_id', $friend->id)->where('friend_id', $user->id)->count() > 0);

    			
    		if ($friend->added) {

    			if ($friend->beenAdded) {

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

					$friend->level = 'warning';
					$friend->message = $friend->name." hasn't accepted your friend's request yet"; 
					return view('friends.add', compact('friend'));


				}

			} else {
 					// fix for case when the other side has already requested, call 'accept request' button on add view
				if ($friend->beenAdded) {

					// you have been added, accept request

					$friend->level = 'warning';
					$friend->message = $friend->name." has requested to be your friend. Accept to see his meds."; 
					return view('friends.add', compact('friend'));


				} else {

					$friend->level = 'warning';
					$friend->message = "You need to be friends to see ".$friend->name."'s meds"; 
					return view('friends.add', compact('friend'));
				}

			}	


		}


		public function addFriend(User $friend) {

			$user = Auth::user();

			$friend->added = (Friendship::where('user_id', $user->id)->where('friend_id', $friend->id)->count() > 0);
			$friend->beenAdded = (Friendship::where('user_id', $friend->id)->where('friend_id', $user->id)->count() > 0);

				if (!$friend->added) {

					$friendship = new Friendship;
					$friendship->user_id = $user->id;
					$friendship->friend_id = $friend->id;
					$friendship->save();
	 
					if (!$friend->beenAdded) {
							// this is still a one-way relationship, so treat as a request.

							// MAIL FORM SMTP GOES TO SPAM, IMPLEMENT MAIL API WITH PROVIDER LIKE MANDRIL
							// // Add action to send e-mail to user with id $friend_id
							// Mail::send('emails.request', ['user' => $user], function ($m) use ($user) {
       //      				$m->from($user->email, $user->name);
       //      				$m->to($friend->email, $friend->name)->subject('Please Add me on MyMeds.miami!');
       // 						 });

							//
						$friend->action = 'Friendship Request Sent to '.$friend->name;
						$friend->level = 'success';
						//return view('friends.home',compact('friends'), compact('friend'));
						return redirect('/friends')->with('data',['success','Friendship Request Sent']);


						} else {

							// the other side has aready sent a request, so this has now become a friendship.


						$friend->action = 'Your are now Friends with '. $friend->name. ' and can see his Meds';
						$friend->level = 'success';

						return redirect('/friends')->with('data',['success','You are now Friends']);
						

					}

				} else { // there is already a relationship from here to there
				
				
					if (!$friend->beenAdded) {
						// it seems like the other side still hasn't accepted you

							// maybe send a reminder email?
						$friend->action = 'Your already requested, still waiting for a response from '.$friend->name;
						$friend->level = 'warning';
						//return view('friends.home',compact('friends'), compact('friend'));
						return redirect('/friends')->with('data',['success','Your already requested this friendship']);


					} else {

						// it seems you are already friends, how the hell did you click on add friend...?

						$friend->action = 'Your are already friends with '.$friend->name;
						$friend->level = 'sucess';
						//return view('friends.home',compact('friends'), compact('friend'));
						return redirect('/friends')->with('data',['success','Your already friends']);

					}
				}

		}




}
