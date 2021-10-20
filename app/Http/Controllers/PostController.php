<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Websites;
use App\Models\WebsiteSubscribers;
use App\Models\Posts;
use Auth;
use Mail;

class PostController extends Controller
{
    /*
     * get all posts 
     */
    public function getAllPosts() {
      // logic to get all goes here
    }

    /*
     * create post
     * @return post array
     */
    public function createPost(Request $request, $websiteId) {
      // logic to create a record goes here
       $website = Websites::where("id", $websiteId)->first();
        $msg = ['message'=> "Website doesnot exist"];
        $errorCode = 201;
        if($website) {
            $userId = Auth::user()->id;//TODO
            $postName = $request->name;
            $postDescription = $request->description;
            $obj = new Posts;
            $obj->name = $postName;
            $obj->description = $postDescription; 
            $obj->website_id = $websiteId;
            $obj->save();
            //$msg['message'] = "Post created successfully";
            $msg = $obj;
            //TODO::send email to all susbscribers
            $websiteSubscribers = WebsiteSubscribers::where("website_id", $websiteId)->get();
            
            
            $details = [];
            foreach($websiteSubscribers as $sub) {
                $data['postTitle'] = $postName;
                $data['postDescription'] = $postDescription;
                $email = $sub->user->email;
                $uname = $sub->user->name;
                $details[] = ["email" => $email, "uname" =>$uname,
                               "data"=>$data];
                
                /*Mail::send(mail, $data, function($message) use($email, $uname) {
                    $message->to('abc@gmail.com', 'Tutorials Point')->subject
                       ('Post subscription successfull');
                    $message->from(config("mail.from.address"), config("mail.from.name"));
                 });*/
            }
            
            dispatch(new \App\Jobs\SendEmail($details));
            
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
