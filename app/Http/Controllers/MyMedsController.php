<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\MedUser;
use App\Med;
use DateTime;


class MyMedsController extends Controller
{

		public function index() {

			$user = Auth::user();
			$mymeds = $user->meds;
			$now = new DateTime();


			for ($x = 0; $x < count($mymeds); $x++) {
			
				$dateexp = new DateTime($mymeds[$x]->pivot->expiration);
				$interval = $now->diff($dateexp);
				$interval = $interval->format('%R%a days');
				$mymeds[$x]['interval'] = $interval;	
					
			}

			return view('meds.mymeds', compact('mymeds'));

	

		}

		
				public function plus($mymed) {

			
			$med = MedUser::find($mymed);
			$qty = $med->qty;
			$qty += 1;
			$med->qty = $qty;
			$med->save();

			// pp\User::find(1)->roles()->save($role, ['expires' => $expires]);


			return back();

		}

	
				public function minus($mymed) {

			
			$med = MedUser::find($mymed);
			$qty = $med->qty;
			$qty -= 1;
			$med->qty = $qty;
			$med->save();

			// pp\User::find(1)->roles()->save($role, ['expires' => $expires]);


			return back();

		}
		
		public function storeMyMeds(Request $request, Med $med) {

			$newMyMed = new MedUser;
			$newMyMed->user_id = Auth::user()->id;
			$newMyMed->med_id = $med->id;
			$newMyMed->qty = $request->qty;
			$newMyMed->expiration = $request->expiration;
			$newMyMed->save();	

			return redirect('/mymeds');
	
		}

		public function addMyMeds(Med $med) {

			return view ('meds.edit_mymed', compact('med'));
	
		}

		

	}
