<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponseTrait 
{

    public function jsonSuccessResponse($result, $message, $statusCode = 200, $headers = array(), Request $request = null, $success = true)
    {
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        if (!empty($result)) {
            if ($result instanceof ResourceCollection) {
                $arrayResult = $result->toArray($request);
                $response['data'] = $arrayResult['data'] ?? null; 
                if (isset($arrayResult['pagination'])) {
                    $response['pagination'] = $arrayResult['pagination'] ?? null;
                }
                if (isset($arrayResult['eventsCount'])) {
                    $response['eventsCount'] = $arrayResult['eventsCount'] ?? null;
                }                
            } elseif (!empty($result)) {
                $response['data'] = $result; 
            }
        }

        return response()->json($response, $statusCode , $headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function jsonErrorResponse($error, $errorMessages = [], $statusCode = 400, $headers = [], $errorType = null)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $errorMessages = $this->decodeErrorMessages($errorMessages);
            $response['errors'] = $errorMessages;
        }

        if (!empty($errorType)) {
            $response['error_type'] = $errorType;
        }

        return response()->json($response, $statusCode, $headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function processPassportErrorResponse($response)
    {
        $responseContent = json_decode($response->getContent(), true);
        $message = $responseContent['error'] ?? 'An unexpected error occurred';
        if ( $responseContent['message'] === "The user credentials were incorrect.") {
            $error = ['message' => 'ایمیل یا گذرواژه کاربر اشتباه است.'];
        } else {
            $error = ['message' => $responseContent['message'] ?? 'No error provided'];
        }

        return [$message, $error];
    }
    
    public function decodeErrorMessages($errorMessages)
    {
        foreach ($errorMessages as $key => $messageArray) {
            if (is_array($messageArray)) {
                foreach ($messageArray as $index => $jsonValue) {
                    if (is_string($jsonValue) && $this->isJsonString($jsonValue)) {
                        $errorMessages[$key][$index] = json_decode($jsonValue, true);
                    }
                }
            }
        }
        return $errorMessages;
    }
    
    public function isJsonString($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
