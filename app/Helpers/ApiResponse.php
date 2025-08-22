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
        return response()->json([
            'data' => null,
            'message' => $message,
            'status' => 'error'
        ], $code);
    }

    public static function pagination($data, $message = 'Success', $paginator)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'pageCount' => $paginator->lastPage(),
            'pageNo' => $paginator->currentPage(),
            'pageSize' => $paginator->perPage(),
            'rowCount' => $paginator->total(),
            'rowEnd' => $paginator->lastItem(),
            'rowStart' => $paginator->firstItem(),
            'status' => 'success'
        ], 200);
    }
}