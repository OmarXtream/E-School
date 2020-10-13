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

}
