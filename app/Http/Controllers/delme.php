				if (Friendship::where('user_id', $friend->id)->where('friend_id', $user->id)->count() > 0) {

						return redirect('/friends/'.$friend->id.'/add')->with('data',['success','You and '/$friend->name'. are now friends']);

				} else {


						return redirect('/friends/'.$friend->id.'/add')->with('data',['success','Friendship to '/$friend->name'. requested.']);
				}



				if (Friendship::where('user_id', $user->id)->where('friend_id', $friend->id)->count() == 0) {

				$friendship = new Friendship;
				$friendship->user_id = $user->id;
				$friendship->friend_id = $friend->id;
				$friendship->save();

				if (Friendship::where('user_id', $friend->id)->where('friend_id', $user->id)->count() == 0) {

						return redirect('/friend/'.$friend->id)->with('data',['success','Friendship to '.$friend->name.' requested.']);

				} else {

						return redirect('/friend/'.$friend->id)->with('data',['success','You and '.$friend->name. ' are now friends']);
						
				}


			} else {

						return redirect('/friend/'.$friend->id)->with('data',['success','You and '.$friend->name.' are already friends!']);
			}
	
		}



		