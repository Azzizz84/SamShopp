<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use PaginateTrait;
    public function index(){
        $contacts = ContactUs::all();
        return view('admin.pages.contact_us.contact_us',compact('contacts'));
    }

    public function delete(Request $request){
        $data = ContactUs::find($request->id);
        $data->delete();
        return $this->apiResponse('delete','success','simple');
    }

}
