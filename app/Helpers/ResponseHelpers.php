<?php

/**
 * Response on success data
 *
 * @param array $data
 * @param integer $code
 * @return Response
 */
function responseSuccessData($data, $code = 200)
{
    return response()->json([
        'status' => 'success',
        'message' => '',
        'data' => $data,
    ], $code);
}

/**
 * Response on success message
 *
 * @param array $data
 * @param integer $code
 * @return Response
 */
function responseSuccessMessage($messages, $code = 200)
{
    if (is_array($messages)) {
        $messages = implode(', ', $messages);
    }

    return response()->json([
        'status' => 'success',
        'message' => $messages,
        'data' => null,
    ], $code);
}

/**
 * Response on success data
 *
 * @param array $data
 * @param integer $code
 * @return Response
 */
function responseErrorData($data, $code = 200)
{
    return response()->json([
        'status' => 'error',
        'message' => '',
        'data' => $data,
    ], $code);
}

/**
 * Response on failure message
 *
 * @param array $errors
 * @param integer $code
 * @return Response
 */
function responseErrorMessage($messages, $code = 200)
{
    if (is_array($messages)) {
        $messages = implode(', ', $messages);
    }

    return response()->json([
        'status' => 'error',
        'message' => $messages,
        'data' => null,
    ], $code);
}

/**
 * Response on Validation Errors
 *
 * @param array $errors
 * @param integer $code
 * @return Response
 */
function responseValidationErrors($errors, $message = null, $code = 422)
{
    return response()->json([
        'status' => 'validations',
        'message' => (empty($message)) ? 'Invalid data' : $message,
        'data' => $errors,
    ], $code);
}

/**
 * Response on paginate
 *
 * @param array $result
 * @param integer $code
 * @return Response
 */
function responsePaginate($result, $append = null, $code = 200)
{
    return response()->json([
        'status' => 'success',
        'message' => '',
        'hasMorePages' => $result->hasMorePages(),
        'nextPageUrl' => $result->nextPageUrl(),
        'total' => $result->total(),
        'perPage' => $result->perPage(),
        'currentPage' => $result->currentPage(),
        'data' => ($append != null) ? ['append' => $append, 'result' => $result->items()] : $result->items(),
    ], $code);
}
