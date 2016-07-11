<?php

namespace App\Http\Controllers;

use Cache;
use App\Util;

class ApiController {


	/**
	 * Return Votes
	 *
	 * GET /api/getVotes
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getVotes()
	{

		return response()->json($apimonitors);
	}



}
