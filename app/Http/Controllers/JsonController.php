<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Med;
use App\Type;

class JsonController extends Controller


{


		public function allMeds() {

			$meds = Med::with('type')->get();
			return $meds;  

		}

		public function allTypes() {

			$type = Type::all();
			return $type;  

		}


		public function addType(Type $type, Request $request) {
		    
		    $type = $type->create($request->all());
			return $type->id;

		}


		public function addMed(Med $med, Request $request) {
		    
		    $med = $med->create($request->all());
			return $med->id;

		}		

		public function searchMed(Request $request) {
		    
			
			$med = Med::with('uses')->where('name', 'like', '%'.$request->med_name.'%')->first();

			return $med;

		}


}



