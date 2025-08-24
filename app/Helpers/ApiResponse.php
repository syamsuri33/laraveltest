<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $pagination = [])
    {
        $response = [
            'data' => $data,
            'message' => $message,
            'status' => 'success'
        ];

        // Tambahkan pagination jika ada
        if (!empty($pagination)) {
            $response = array_merge($response, $pagination);
        }

        return response()->json($response, 200);
    }

    public static function error($message = 'Error', $code = 400)
    {
        $response = [
            'data' => null,
            'message' => $message,
            'status' => 'error'
        ];

        return response()->json($response, $code);
    }

    public static function pagination($data, $message = 'Success', $paginator)
    {
        $response = [
            'data' => $data,
            'message' => $message,
            'status' => 'success',
            'pageCount' => $paginator->lastPage(),
            'pageNo' => $paginator->currentPage(),
            'pageSize' => $paginator->perPage(),
            'rowCount' => $paginator->total(),
            'rowStart' => $paginator->firstItem(),
            'rowEnd' => $paginator->lastItem(),
        ];

        return response()->json($response, 200);
    }
}