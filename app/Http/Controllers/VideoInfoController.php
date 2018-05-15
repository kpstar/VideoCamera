<?php

namespace App\Http\Controllers;

use App\VideoInfo;
use Illuminate\Http\Request;

class VideoInfoController extends Controller
{

	public function uploadvideo ( Request $request)
	{
		$nowtime = time();
		$randomname = rand(1000, 9999);
		$createdrandom_name = $randomname.$nowtime;
		$video_name = $createdrandom_name.".mp4";
		$image_name = $createdrandom_name.".png";
		$request->video->move('./uploads/',$video_name);
		$request->image->move('./uploads/',$image_name);

		$image_url = asset('uploads/'.$image_name);
		$video_url = asset('uploads/'.$video_name);

		$videoinfo = new VideoInfo;
		$videoinfo->videofileurl = $video_url;
		$videoinfo->imgfileurl = $image_url;
		$videoinfo->coor_lng = $request->longitude;
		$videoinfo->coor_lat = $request->latitude;
		$videoinfo->save();


		return $image_url;
	}

	public function posturl ()
	{

		$videourls = \DB::table('video_infos')->get();
		return $videourls;
	}
}
