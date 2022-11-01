<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TongDai;

class ApiPhoneController extends Controller
{
    function list()
    {
        return TongDai::all();
    }
    function store(Request $request)
    {

        //su dung www-form // form data
        // return $request->number;

        $tongdai = new TongDai();

        if (!isset($request->number)){
            return [
                'status' => 0,
                'message' => 'Check number'
            ];
        }
        $tongdai->number = $request->number;

        if($request->ip){
            $tongdai->ip = $request->ip;
        } else{
            $tongdai->ip = $request->ip();
        }

        if ($tongdai->save()) {
            return [
              'status' => 1,
              'message' => 'insert success'
            ];
        } else {
            return [
                'status' => 1,
                'message' => 'insert phone failed'
            ];
        }
    }

    function store_backup(Request $request)
    {

        //su dung www-form // form data
        // return $request->number;


        // su dung raw trong postman
        $rawPostData = file_get_contents("php://input"); //json
        //convert to array
        $data_arr = json_decode($rawPostData, true);

        $tongdai = new TongDai();
        if (!array_key_exists("number", $data_arr)) {
            return ['data' => 'check field number'];
        }
        $tongdai->number = $data_arr['number'];

        if (array_key_exists("ip", $data_arr)) {
            $tongdai->ip = $data_arr['ip'];
        } else {
            $tongdai->ip = $request->ip();
        }
        if ($tongdai->save()) {
            return ['status' => 'ok'];
        } else {
            return ['data' => 'insert phone failed'];
        }
    }
}
