<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $apiBaseUrl;
    private $client;

    public function __construct(Client $client)
    {
        $this->apiBaseUrl = env('API_BASE_URL');
        $this->client = $client;
    }

    public function register(RegisterUserRequest $request)
    {
        $apiRequestBody = [
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'repeatPassword' => $request->password_confirmation,
        ];

        $response = $this->client->post("$this->apiBaseUrl/users", [
            'headers' => [
                'Content-type' => 'application/json',
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200) {
            return redirect()->route('login');
        } else {
            return back()->withInput();
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $apiRequestBody = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $response = $this->client->post("$this->apiBaseUrl/users/login", [
            'headers' => [
                'Content-type' => 'application/json',
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            session(['api_token' => $responseData['token']]);
            session(['user_id' => $responseData['id']]);
            return redirect()->route('dashboard');
        } else {
            return back()->withInput();
        }
    }

    public function logout()
    {
        session()->forget('api_token');
        session()->forget('user_id');
        return redirect()->route('login');
    }
}
