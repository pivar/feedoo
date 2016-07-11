<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

	public function index()
	{
		$feed = app('bbcfeed');
	  $getFeed = $feed->feedmaker();
	  if($getFeed['error']){
	    return view('home')->with(['error' =>$getFeed['error']]);
	  } else{
	    return view('home')->with(['data' =>$getFeed]);
	  }
	}

}
