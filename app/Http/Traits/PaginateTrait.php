<?php

namespace App\Http\Traits;
use Illuminate\Support\Collection;
Trait  PaginateTrait
{
    //===================  ApiResponse ===========================
    private function apiResponse($object = '',$message = 'success',$type='object',$code = 200,$stopSort = false,$responseCode = 200)
    {
        if ($type=='simple'){
            return response()->json(['data'=>$object,'message'=>$message,'code'=>intval($code)],$responseCode);
        }
        $page = request()->get('page');
        $skip = request()->get('skip')??10;
        $orderBy = request()->get('orderBy');
        $random = request()->get('random')??false;

        if (!isset($orderBy) || !in_array($orderBy, ['asc', 'desc'])) {
            $orderBy = 'desc';
        }
        if ($object instanceof Collection) {

            $data = $object;
        } else {
            if($random){
                $data = $object->inRandomOrder()->get();
            }else{
                $data = $object->get();
            }
        }

        if(!$random){
            if(!$stopSort){
                if($orderBy=='asc'){
                    $data = $data->sortBy('id');
                }else{
                    $data = $data->sortByDesc('id');
                }
            }
        }
        if(!$stopSort){
            $data = $data->values();
        }

        $total = $data->count();


        if (isset($page)) {

            if (!($page != '' && is_numeric($page) && $page > 0)) {
                $page = 1;
            }
            $page --;
            $data = $data->skip($page*$skip)->take($skip);
            $data = $data->values();
        }

        $json = collect(['data'=>$data,"message" => $message,"code" => intval($code),"total"=>$total]); ;
        return response()->json($json,200);
    }
}
