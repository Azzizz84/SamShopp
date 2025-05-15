<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\CreateAddressRequest;
use App\Http\Requests\Api\Address\DeleteAddressRequest;
use App\Http\Requests\Api\Address\EditAddressRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use PaginateTrait;
    public function create_address(CreateAddressRequest $request){
        $data = $request->all();
        $data['user_id'] = userApi()->id;
        $address = Address::create($data);
        $address = Address::find($address->id);
        return $this->apiResponse($address,'success','simple');
    }

    public function edit_address(EditAddressRequest $request){
        $data = $request->all();
        Address::find($request->id)->update($data);
        $address = Address::find($request->id);
        return $this->apiResponse($address,'success','simple');
    }

    public function delete_address(DeleteAddressRequest $request){
        $data = Address::find($request->id);
        if($data){
            $data->delete();
        }
        return $this->apiResponse('success','success','simple');
    }
    public function get_address(Request $request){
        $address = Address::where('user_id',userApi()->id);
        return $this->apiResponse($address);
    }
}
