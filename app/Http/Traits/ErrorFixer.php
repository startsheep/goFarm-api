<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

/**
 * Error Fixer
 */
trait ErrorFixer
{
    public function createError()
    {
        return response()->json([
            'message' => 'Fail, data failed to create',
            'status' => 'error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function updateError()
    {
        return response()->json([
            'message' => 'Fail, data failed to update',
            'status' => 'error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function deleteError()
    {
        return response()->json([
            'message' => 'Fail, data failed to delete',
            'status' => 'error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
