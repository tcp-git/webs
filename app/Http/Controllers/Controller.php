<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected function returnDataResponse($data){
        return response()->json([
            'success' => true,
            'data' => $data
        ],200);
    }

    protected function returnDataWithPageResponse($data, $sort = []){
        return response()->json([
            'success' => true,
            'data'=> $data->items(),
            'page' => [
              'current_page' => $data->currentPage(),
              'from' => $data->firstItem(),
              'to' => $data->lastItem(),
              'per_page' => $data->perPage(),
              'last_page' => $data->lastPage(),
              'total' => $data->total(),
            ],
            'sort' => [
              'sort_by' => (isset($sort['sort_by'])) ? $sort['sort_by'] : null,
              'order_by' => (isset($sort['order_by'])) ? $sort['order_by'] : null
            ]
          ], 200);
    }

    protected function returnErrorResponse($status_code, $mesage, $error_code){
        // switch($status_code){
        //     case '500' :

        // }

        return response()->json([
            'success' => false,
            'error' => $mesage,
            'error_code' => $error_code
        ], $status_code);
    }

}
