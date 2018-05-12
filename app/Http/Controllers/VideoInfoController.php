<?php

namespace App\Http\Controllers;

use App\VideoInfo;
use Illuminate\Http\Request;

class VideoInfoController extends Controller
{

	public function uploadvideo ( Request $request)
	{
		// $geo_location = $request->geolocation;
		// $cur_date = $request->date;
		$back_video = $request->video;
		$video_name = $back_video->getClientOriginalName();
		$back_video->move('./uploads/',$video_name);
		return $video_name;
	}
}
