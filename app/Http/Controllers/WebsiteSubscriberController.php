<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Websites;
use App\Models\WebsiteSubscribers;
use Auth;

class WebsiteSubscriberController extends Controller
{
    
    /*
     * subscribe user to website
     * @param $websiteId website id
     * @return json
     */
    public function createSubscription(Request $request, $websiteId) {
        $website = Websites::where("id", $websiteId)->first();
        $msg = ['message'=> "Website doesnot exist"];
        $errorCode = 201;
        if($website) {
            $userId = (Auth::check()) ? Auth::user()->id : $request->userId;//TODO
            if(!$userId) {
                $msg['message'] = "Either login or pass userId";
                $errorCode = 200;
                 return response()->json($msg, $errorCode);
            }
            //check if user is already subscurverd to this website
            $wobj = WebsiteSubscribers::where("user_id", $userId)->where("website_id", $websiteId)->first();
            if(!$wobj) {
                //if no then subscribe
                $obj = new WebsiteSubscribers;
                $obj->user_id = $userId;
                $obj->website_id = $websiteId;
                $obj->save();
                $msg['message'] = "User suubscibed to website successfully";
                //TODO::send email
            } else {
                //retrun mesg
                $msg['message'] = "User already subscribed to this website";
                
            }
        } else {
             $msg['message'] = "Website doesnot exist";
             $errorCode = 201;
        }
        
         return response()->json($msg, $errorCode);
        
    }

    public function getPost($id) {
      // logic to get a record goes here
    }

    public function updatePost(Request $request, $id) {
      // logic to update a record goes here
    }

    public function deletePost ($id) {
      // logic to delete a record goes here
    }
}
