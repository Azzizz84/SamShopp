<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use PaginateTrait;
    public function contact_us(Request $request){
        $data = $request->all();
        ContactUs::create($data);
        return $this->apiResponse('success','success','simple');
    }
}
