<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ResetPasswordController as Reset;

class ResetPasswordController extends Reset
{
    use RedirectsUsers;
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'El :attribute es un campo requerido',
            'email.required' => 'El :attribute es un campo requerido',
            'email.email' => 'El :attribute debe ser un email valido',
            'password.required' => 'El :attribute es un campo requerido',
            'password.required' => 'El :attribute es un campo requerido'
        ];
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' =>$response]);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => $response], 422);
    }


}
