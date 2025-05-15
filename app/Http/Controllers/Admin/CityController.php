<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\AddCityRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use PaginateTrait;
    public function index(){
        $cities = City::all();
        $cities->each->makeVisible('*');
        return view('admin.pages.city.cities',compact('cities'));
    }
    public function change($id){
        $admin = admin_user();
        if(admin_user()->super){
            $admin->city_id = $id;
            $admin->save();
        }else{
            $exists = $admin->cities()->where('city_id',$id)->first();
            if($exists){
                $admin->city_id = $id;
                $admin->save();
            }
        }
        return redirect()->route('home');
    }
    public function add_city(){
        return view('admin.pages.city.add_city');
    }
    public function store(AddCityRequest $request){
        $data = $request->all();
        City::create($data);
        return $this->apiResponse(route('cities'),'success','simple');
    }
    public function edit($id){
        $city = City::where('id',$id)->first();
        return view('admin.pages.city.add_city',compact('city'));
    }
    public function update(AddCityRequest $request){
        $data = $request->only('name_ar','name_en');
        City::find($request->id)->update($data);
        return $this->apiResponse(route('cities'),'success','simple');
    }
    public function delete(Request $request){
        City::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
