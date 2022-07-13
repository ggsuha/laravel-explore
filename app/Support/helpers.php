<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\LazyCollection;

if (! function_exists('response_json')) {
    /**
     * Create a new JSON response instance with the given data.
     *
     * @param  mixed|null  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return \Illuminate\Http\JsonResponse
     */
    function response_json($data = null, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        $data = $data ?? new stdClass;

        return response()->json(compact('data'), $status, $headers, $options);
    }
}
