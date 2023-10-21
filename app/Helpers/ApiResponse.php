<?php

namespace App\Helpers;

class ApiResponse
{
    public static function dataTable($status, $message = null, $data = null, $recordsTotal = null, $draw = null)
    {
        return response()->json([
            'status' => 'success',
            'status_code' => $status,
            'message' => $message,
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => count($data),
            'data' => $data
        ], $status);
    }

    public static function success($status, $message = null, $data = null)
    {
        return response()->json([
            'status' => 'success',
            'status_code' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function failed($status, $message = null, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'status_code' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
