<?php

namespace App\Http\Controllers;

use Cache;
use App\Util;
use Illuminate\Http\Request as Request;

class ApiController {

	/**
	 * Add VotesUp
	 *
	 * POST /api/addVotesUp
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function addVotesUp(Request $request)
	{
		if(\Request::ajax()) {
				$feedKey = $request->input('feed_id');
				// call shared fuction
				$votes= $this->votingOperations($feedKey,"upVotes");
			}

			return response()->json($votes);
	}


	/**
	 * Add VotesDown
	 *
	 * POST /api/addVotesDown
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function addVotesDown(Request $request)
	{
		if(\Request::ajax()) {
				$feedKey = $request->input('feed_id');
				// pass references to shared function with type of operation
			  $votes= $this->votingOperations($feedKey,"downVotes");
			}
		return response()->json($votes);
	}


	/*********
	* Shared function for similar operation
	*
	***********/

 public function votingOperations($feedKey, $typeOperation){
	 $numVotes = 0; // counter for votes
	 $flagFound =0; // flag to append new node in xml
			 // read XML for specific feedKey & fetch Count
			 // append count & return same
			 $storage_path = storage_path().env('XML_PATH');
			 $xml = simplexml_load_file($storage_path."/feed.xml");
			 // loop through xml nodes and match the link
			 foreach($xml->item->feedLink as $feedGroup)
				 {
					 $titleString = (string) $feedGroup->title;

					 if ($titleString == $feedKey)
					 {
						 if($typeOperation =="upVotes"){
							 // fetch stored upVotes and increment by 1
							 $numVotes = (integer)$feedGroup->votes['upVotes']+1;
							 $feedGroup->votes['upVotes'] = $numVotes;
						 } else{
							 // fetch stored downVotes and increment by 1
							 $numVotes = (integer)$feedGroup->votes['downVotes']+1;
							 $feedGroup->votes['downVotes'] = $numVotes;
						 }

						 // set this flag for a new entry
						 $flagFound =1;
						 break;
					 }
				 }

			 if(!$flagFound){
				 $numVotes = 1;
				 // its a new vote for feed never voted thus create a new child node in XML
				 $child = $xml->item->addChild('feedLink');
				 $title = $child->addChild('title', $feedKey);
				 $votes = $child->addChild('votes', '');
				 if($typeOperation =="upVotes"){
					 $votes->addAttribute('upVotes', 1);
					 $votes->addAttribute('downVotes', 0);
				 } else {
					 $votes->addAttribute('upVotes', 0);
					 $votes->addAttribute('downVotes', 1);
				 }

			 }
			 file_put_contents($storage_path.'/feed.xml', $xml->asXml());
	  return $numVotes;
 }

}
