<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Med;

class SearchController extends Controller
{
    //

public function results(Request $request) {
	$users = User::where('name','LIKE',"%$request->q%")->get();
	$meds = Med::where('name','LIKE',"%$request->q%")->get();

	return view('pages.results', compact('users'),compact('meds'));
}


}
