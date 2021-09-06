<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PalindromeResource;
use Illuminate\Http\Request;

class PalindromeController extends Controller
{
    public function __invoke($string = null)
    {
        $status = false;

        $check = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string));

        if (strrev($check) == $check && strlen($check) >= 1) {
            $status = true;
        }

        $data['text'] = $string;
        $data['status'] = $status;

        return new PalindromeResource($data);
    }
}
