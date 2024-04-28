<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SeenVideo;
use App\Models\Customer;
use App\Models\PromotionalVideo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SeenVideosController extends Controller
{

    public function store(Request $request)
    {     
        $sv = new SeenVideo;
        $sv->customer_id = $request->customer_id;
        $sv->video_id = $request->video_id;
        $sv->day_date = Carbon::now();
        $sv->save(); 
       // $videoLink = PromotionalVideo::where('id',$request->video_id)->first();
    //    $externalLink = $videoLink->link; // Your external link here

      //  return redirect()->away($externalLink);
     // return back()->with('success', 'تم الاشتراك'); 
      return back();
                
    }  
   
}
