<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Websites;
use App\Models\WebsiteSubscribers;
use Auth;

class WebsiteController extends Controller
{
    /*
     * get all WEbsites 
     */
    public function getAllWebsites() {
      // logic to get all goes here
    }

    public function createWebsite(Request $request) {
      // logic to create a record goes here
               
        $obj = new Websites;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->domain_url = ($request->has('domain_url')) ? $request->domain_url : '';
        $obj->save();
        //$msg['message'] = "Website created successfully";
        $msg = $obj; 
        return response()->json($msg, 201);
        
    }

    public function getWebsite($id) {
      // logic to get a record goes here
    }

    public function updateWebsite(Request $request, $id) {
      // logic to update a record goes here
    }

    public function deleteWebsite ($id) {
      // logic to delete a record goes here
    }
}
