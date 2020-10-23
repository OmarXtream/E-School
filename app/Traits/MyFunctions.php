<?php
namespace App\Traits;

Trait MyFunctions
{
    function RespSuccess($msg){
        return [
            'tp' => 'success',
            't' => 'حسناً',
            'm' => ['success' => [$msg] ],
            'b' => false,

        ];
    }

    function RespError($errors,$tp = 'error'){
        return [
            'tp' => $tp,
            't' => 'خطأ',
            'm' => $errors,
            'b' => true,

        ];
    }

    function CheckandJS(){
        $validator = Validator::make($request->all(), [
            'key' => 'bail|required|string|unique:keys,key|max:30'
        ]);

        if ($validator->fails()) {
            $response = $this->RespError($validator->errors());
            return json($response);
        }else{
            return false;
        }

    }

    function in_array_strpos($word, $array){

        foreach($array as $a){

            if (strpos($word,$a) !== false) {
                return true;
            }
        }

        return false;
        }



}
