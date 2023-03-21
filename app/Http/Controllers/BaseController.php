<?php

namespace App\Http\Controllers;

class BaseController extends Controller {
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message = 'Successfully fetched data', $code = 200) {
        $response = [
            'message' => $message,
            'success' => true,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) $response['data'] = $errorMessages;

        return response()->json($response, $code);
    }
}
