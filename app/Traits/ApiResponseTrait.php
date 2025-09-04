<?php
namespace App\Traits;

Trait ApiResponseTrait{
    public function response_success($data  , $massage = "Success"){
        return response()->json(['Status'=>true ,'Massage'=>$massage , 'Data'=>$data ]);
    }
    public function response_error($massage = "Error" , $code = 400){
        return response()->json(['Status'=>false ,'Massage'=>$massage ] , $code);
    }
}