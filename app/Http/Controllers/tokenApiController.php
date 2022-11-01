<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\tokenAPI;

class tokenApiController extends Controller
{
    function show()
    {
        $token = tokenAPI::find(1)->first();;
        return view('backend/tokenAPI/index',[
            'token' => $token
        ]);
    }

    function make()
    {
        $current_user = Auth::guard('admin')->user();
        $token = $current_user->createToken("name-token");

        if (tokenAPI::all()->count() > 0) {
            $tokenAPI = tokenAPI::find(1);
            $tokenAPI->token = $token->plainTextToken;
            $tokenAPI->save();
        } else {
            $tokenAPI = new tokenAPI();
            $tokenAPI->token = $token->plainTextToken;
            $tokenAPI->save();
        }

        return ['token' => $token->plainTextToken];

        exit();
    }
}
