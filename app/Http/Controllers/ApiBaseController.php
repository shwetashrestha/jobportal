<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function sendResponse($data, $message)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], 200);
    }
    public function sendError($code=404, $message){
        return response()->json([
            'success'=>false,
           'message' => $message
        ], $code);
      
    }

}
