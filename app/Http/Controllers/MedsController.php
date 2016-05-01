<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Med;
use App\Type;
use App\MedUse;
use Auth;

class MedsController extends Controller
{

 

		public function index() {

			$meds = Med::all();
			$types = Type::all();
			return view('meds.meds', compact('meds'), compact('types'));  

		}

		public function show(Med $med) {

			$med->load('uses.user.meds');
			return view ('meds.show', compact('med'));

		}

		public function store(Request $request, Med $med) {
	    
		    $med->create($request->all());
			return redirect('/meds')->with('data',['success','Medication Added']);

	    
	   	}
	    
		public function edit(Med $med) {

			$types = Type::all();
			return view ('meds.edit', compact('med'), compact('types'));
	
		}

		public function update(Request $request, Med $med) {

			$med->update($request->all());

			return redirect('/meds')->with('data',['success','Medication Updated']);

		}


		public function delete(Med $med) {

			 $med->delete();
			return redirect('/meds')->with('data',['danger','Mediction Deleted']);

		}
		


		public function newType(Request $request, Type $type) {

		   	$type->create($request->all());
			return redirect('/meds')->with('data',['success','New Type Added']);

		}
		

		public function uses() {


			$meds = Med::with('uses', 'users', 'type')->get();
			return view('meds.uses', compact('meds'));

		}



		public function newUse(Request $request, MedUse $use) {

		   	$use = new MedUse;
		   	$use->med_id = $request->med_id;
		   	$use->user_id = Auth::user()->id;
		   	$use->use = $request->use; 
		   	$use->save();

			return back();

		}






}
