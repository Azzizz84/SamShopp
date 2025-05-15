<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use PaginateTrait;
    public  function index(){
        $settings = Setting::first();
        $settings->makeVisible('*');
        return view('admin.pages.settings.settings',compact('settings'));
    }

    public  function update(Request $request){
        Setting::first()->update($request->all());
        return $this->apiResponse(route('settings'),'success','simple');
    }


    public function privacy(){
        $settings = Setting::first();
        $title = __('admin.policy');
        $data = [];
        $data['title'] = $title;
        $data['body'] = $settings->privacy;
        return view('webview.web_view',compact('data'));
    }
    public function terms(){
        $settings = Setting::first();
        $title = __('admin.terms');
        $data['title'] = $title;
        $data['body'] = $settings->terms;
        return view('webview.web_view',compact('data'));
    }
    public function about(){
        $settings = Setting::first();
        $title = __('admin.about');
        $data['title'] = $title;
        $data['body'] = $settings->about;
        return view('webview.web_view',compact('data'));
    }
    public function return(){
        $settings = Setting::first();
        $title = __('admin.return');
        $data['title'] = $title;
        $data['body'] = $settings->return;
        return view('webview.web_view',compact('data'));
    }
}
