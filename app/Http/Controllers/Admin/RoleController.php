<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use PaginateTrait;
    public function index(){
        $permissions = Role::all();
        return view('admin.pages.permission.permissions',compact('permissions'));
    }
    public function add(){
        $permissions = Permission::all();
        $permission_section = $this->createList();

        return view('admin.pages.permission.add_permission',compact('permissions','permission_section'));
    }
    public function store(Request $request){
        $data = $request->only('name_ar','name_en');
        $role = Role::create($data);
        $permission_section = $this->createList();
        foreach ($permission_section as $section){
            $value = $request->input($section['view']);
            if($value){
                $permission = Permission::where('key_name',$section['view'])->first();
                RolePermission::create(
                    [
                        'role_id'=>$role->id,
                        'permission_id'=>$permission->id,
                    ],
                );
            }
            if(isset($section['edit'])){
                $value = $request->input($section['edit']);
                if($value){
                    $permission = Permission::where('key_name',$section['edit'])->first();
                    RolePermission::create(
                        [
                            'role_id'=>$role->id,
                            'permission_id'=>$permission->id,
                        ],
                    );
                }
            }

        }
        return $this->apiResponse(route('permissions'),'success','simple');
    }
    public function edit($id){
        $permission = Role::find($id);
        $permission_section = $this->createList();
        return view('admin.pages.permission.add_permission',compact('permission','permission_section'));
    }
    public function update(Request $request){
        $data = $request->only('name_ar','name_en');
        Role::find($request->id)->update($data);
        RolePermission::where('role_id',$request->id)->delete();
        $permission_section = $this->createList();
        foreach ($permission_section as $section){
            $value = $request->input($section['view']);
            if($value){
                $permission = Permission::where('key_name',$section['view'])->first();
                RolePermission::create(
                    [
                        'role_id'=>$request->id,
                        'permission_id'=>$permission->id,
                    ],
                );
            }
            if(isset($section['edit'])){
                $value = $request->input($section['edit']);
                if($value){
                    $permission = Permission::where('key_name',$section['edit'])->first();
                    RolePermission::create(
                        [
                            'role_id'=>$request->id,
                            'permission_id'=>$permission->id,
                        ],
                    );
                }
            }

        }
        return $this->apiResponse(route('permissions'),'success','simple');
    }
    public function delete(Request $request){
        Role::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }

    public function createList(){
        $permission_section = [];
        $permission_section['category'] = [
            "title"=>"categories",
            "view"=>"category_view",
            "edit"=>"category_edit",
        ];
        $permission_section['sub_category'] = [
            "title"=>"sub_categories",
            "view"=>"sub_category_view",
            "edit"=>"sub_category_edit",
        ];
        $permission_section['user'] = [
            "title"=>"users",
            "view"=>"user_view",
            "edit"=>"user_edit",
        ];
        $permission_section['market'] = [
            "title"=>"markets",
            "view"=>"market_view",
            "edit"=>"market_edit",
        ];
        $permission_section['rates'] = [
            "title"=>"rates",
            "view"=>"rate_view",
            "edit"=>"rate_edit",
        ];

        $permission_section['products'] = [
            "title"=>"products",
            "view"=>"product_view",
        ];
        $permission_section['services'] = [
            "title"=>"services",
            "view"=>"service_view",
            "edit"=>"service_edit",
        ];
        $permission_section['order'] = [
            "title"=>"orders",
            "view"=>"order_view",
            "edit"=>"order_edit",
        ];
        $permission_section['service_order'] = [
            "title"=>"service_orders",
            "view"=>"service_order_view",
            "edit"=>"service_order_edit",
        ];
        $permission_section['service_provider'] = [
            "title"=>"service_providers",
            "view"=>"service_provider_view",
            "edit"=>"service_provider_edit",
        ];

        $permission_section['settings'] = [
            "title"=>"settings",
            "view"=>"settings_view",
        ];
        $permission_section['admin'] = [
            "title"=>"admins",
            "view"=>"admin_view",
            "edit"=>"admin_edit",
        ];
        $permission_section['permission'] = [
            "title"=>"permissions",
            "view"=>"permission_view",
            "edit"=>"permission_edit",
        ];
        $permission_section['banners'] = [
            "title"=>"banners",
            "view"=>"banner_view",
            "edit"=>"banner_edit",
        ];
        $permission_section['notification'] = [
            "title"=>"notifications",
            "view"=>"notification_view",
            "edit"=>"notification_edit",
        ];
        $permission_section['contact_us'] = [
            "title"=>"contact_us",
            "view"=>"contact_us_view",
            "edit"=>"contact_us_edit",
        ];

        return $permission_section;
    }
}
