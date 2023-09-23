<?php

namespace App\Http\Controllers;

trait ResponseTrait
{
    public function jsonResponse($data, $message, $status){
        return response()->json([
            'data'      => $data,
            'message'   => $message,
            'status'    => $status
        ]);
    }

    public function successResponse($data, $message = null){
        return $this->jsonResponse($data, $message, 200);
    }

    public function modifyResponse($data, $message = null){
        return $this->jsonResponse($data, $message, 201);
    }

    public function invalidResponse($data, $message = null){
        return $this->jsonResponse($data, $message, 400);
    }

    public function errorResponse($data = null, $message = 'NOT Found.'){
        return $this->jsonResponse($data, $message, 404);
    }

    public function serveErrorResponse($data = null, $message = 'An error occurred while fetching the Request.'){
        return $this->jsonResponse($data, $message, 500);
    }
}
