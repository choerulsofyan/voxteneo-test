<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $apiRequestBody = [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'repeatPassword' => $request->password_confirmation,
        ];

        // Send the request to the external API using Guzzle
        $client = new Client();
        $response = $client->post($apiBaseUrl . '/users', [
            'headers' => ['Content-type' => 'application/json'],
            'json' => $apiRequestBody,
        ]);

        // Process the API response as needed
        $apiResponse = json_decode($response->getBody(), true);

        // Return a response to the user based on the API response
        if ($response->getStatusCode() === 200) {
            return response()->json(['message' => 'Registration successful'], 200);
        } else {
            return response()->json(['error' => 'Registration failed'], 500);
        }
    }

    public function login(Request $request)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $apiRequestBody = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Send the login request to the external API using Guzzle
        $client = new Client();
        $response = $client->post($apiBaseUrl . '/users/login', [
            'headers' => ['Content-type' => 'application/json'],
            'json' => $apiRequestBody,
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($response->getStatusCode() === 200) {

            session(['api_token' => $responseData['token']]);

            // Return the authenticated response to the user
            return response()->json($responseData, 200);
        }

        return response()->json(['error' => 'Login failed'], 401);
    }
}
