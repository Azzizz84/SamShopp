<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\RegisterAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Http\Requests\Admin\LoginAdminRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Admin;
use App\Models\AdminCity;
use App\Models\City;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminController extends Controller
{
    use PaginateTrait;
    public function index(){
        if (admin()->check()){
            return redirect()->route('home');
        }
        return view('admin.pages.auth.auth');
    }

    public function login(LoginAdminRequest $request){
        $credentials = $request->only('email', 'password');
        try {
            $token = admin()->attempt($credentials);
            if(!$token){
                return $this->apiResponse(null,__('validation.login_field'),'simple',"500");
            }
            $admin = admin_user();
            if($admin->super==0){
                $cities = $admin->cities()->first();
                if($cities){
                    $admin->city_id = $cities->id;
                    $admin->save();
                }else{
                    $admin->city_id = 0;
                    $admin->save();
                }
            }else{
                $city = City::first();
                if($city){
                    $admin->city_id = $city->id;
                    $admin->save();
                }

            }
            return  $this->apiResponse('success'
                ,'success','simple');
        } catch (JWTException $e) {
            return $this->apiResponse(null,__('validation.error'),'simple',"500");
        }
    }

    use PaginateTrait;
    public function admins(){
        $admins = Admin::all();
        return view('admin.pages.admin.admin',compact('admins'));
    }
    public function add(){

        $roles = Role::all();
        $cities = City::all();
        if(!admin_user()->super){
            $cities = admin_user()->citites;
        }
        return view('admin.pages.admin.add_admin',compact('roles','cities'));
    }
    public function store(RegisterAdminRequest $request){
        $data = $request->except('cities');
        $data['password'] = Hash::make($request->password);
        $admin = Admin::create($data);
        $admin = Admin::find($admin->id);
        if(isset($request->cities)){
            foreach ($request->cities as $city){
                AdminCity::create([
                    "admin_id"=>$admin->id,
                    "city_id"=>$city,
                ]);
            }
        }
        return $this->apiResponse(route('admins'),'success','simple');
    }
    public function edit($id){
        $admin = Admin::find($id);
        $roles = Role::all();
        $cities = City::all();
        if(!admin_user()->super){
            $cities = admin_user()->citites;
        }
        return view('admin.pages.admin.add_admin',
            compact('admin','roles','cities'));
    }
    public function update(UpdateAdminRequest $request){
        $count = Admin::where('id','!=',$request->id)->where('phone',$request->phone)->count();
        if($count>0){
            return $this->apiResponse(__('validation.unique_phone'),__('validation.user_name_unique'),'simple',500);
        }
        $count = Admin::where('id','!=',$request->id)->where('email',$request->email)->count();
        if($count>0){
            return $this->apiResponse(__('validation.unique_email'),__('validation.user_name_unique'),'simple',500);
        }
        $data = $request->except('cities');
        if(isset($request->password)&&$request->password!=null) {
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        Admin::find($request->id)->update($data);
        AdminCity::where('admin_id',$request->id)->delete();
        if(isset($request->cities)){
            foreach ($request->cities as $city){
                AdminCity::create([
                    "admin_id"=>$request->id,
                    "city_id"=>$city,
                ]);
            }
        }

        return $this->apiResponse(route('admins'),'success','simple');
    }
    public function delete(Request $request){
        Admin::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
    public function logout(){
        admin()->logout();
        return redirect()->route('home');
    }
}
