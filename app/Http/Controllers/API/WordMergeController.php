<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordMergeResource;

class WordMergeController extends Controller
{
    public function __invoke($string = null)
    {
        if ($string == null) {
            $data['message'] = "Data tidak boleh kosong";

            $resource = new WordMergeResource($data);
            return $resource->response()->setStatusCode(400);
        }

        $pisah = explode(",", $string);

        if (!isset($pisah[1])) {
            $data['message'] = "Format data keliru";

            $resource = new WordMergeResource($data);
            return $resource->response()->setStatusCode(400);
        }

        $data['int'] = trim($pisah[1]);
        $data['input'] = trim(str_replace('"', '', $pisah[0]));
        $check = array_unique(str_split(preg_replace('/[^A-Za-z0-9\-]/', '', $pisah[0]), $pisah[1]));

        foreach ($check as $value) {
            $split = str_split($value);
            $output[] = join("", array_unique($split));
        }

        $data['output'] = $output;

        $resource = new WordMergeResource($data);
        return $resource->response()->setStatusCode(200);
    }
}
