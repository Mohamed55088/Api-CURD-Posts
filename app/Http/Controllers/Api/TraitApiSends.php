<?php
namespace App\Http\Controllers\Api;


trait TraitApiSends
{
    public function Sends($data, $status)
    {
        return response()->json(['posts' => $data, 'msg' => 'yes'], $status);
    }
}