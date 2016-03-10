<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Med;
use App\Type;


class MedsController extends Controller
{

 

		public function index() {

			$meds = Med::all();
			$types = Type::all();
			$active = "meds";
			return view('meds.meds', compact('meds'), compact('types'), compact('active'));  

		}

		public function show(Med $med) {

			return view ('meds.show', compact('med'));

		}

		public function store(Request $request, Med $med) {
	    
		    $med->create($request->all());
		    return back();

	    
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
		
	   	

}
