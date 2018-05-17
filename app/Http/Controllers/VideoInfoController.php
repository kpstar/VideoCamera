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
		if($request->video->move('./uploads/',$video_name)) {
			$video_url = asset('uploads/'.$video_name);
			$videoinfo = new VideoInfo;
			$videoinfo->videofileurl = $video_name;
			$videoinfo->address = $request->address;
			$videoinfo->createdate = $request->time;
			$videoinfo->user = $request->user;
			$videoinfo->save();


			return $request;
		}
		return "fail";
	}

	public function posturl ( Request $request)
	{
		$username = $request->username;
		$videos = VideoInfo::where('user', $username)->get();
		$final_videos = array();
		if ($videos) {
			foreach ($videos as $video) {
				$final_videos[] = array(
					'id' => $video->id,
					'address' => $video->address,
					'videofileurl' => asset('uploads/'.$video->videofileurl),
					'createdate' => $video->createdate,
					'uploaddate' => $video->createdate
				);
			}
		}

		return response()->json($final_videos);
	}

	public function removevideo ( Request $request)
	{
		$videoInfo = VideoInfo::where('videofileurl', $request->url)->first();
		if ($videoInfo) {
			$abdpath = 'uploads/'.$videoInfo->videofileurl;

			if(file_exists($abdpath)){
				unlink($abdpath);
			}

			$videoInfo->delete();
			return "success";
		}
		return "fail";
	}
}
