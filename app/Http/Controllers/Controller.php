<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

	public function index()
	{
		$feed = app('bbcfeed');
	  $getFeed = $feed->feedmaker();
	  if($getFeed['error']){
			// if some error just display differently
	    return view('home')->with(['error' =>$getFeed['error']]);
	  } else{
			// if not error then count total feeds, match with existing
			// XML file to fetch the data of votes per post
			// 
	    return view('home')->with(['data' =>$getFeed]);
	  }
	}

}
