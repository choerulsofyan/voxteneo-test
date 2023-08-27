<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $apiBaseUrl;
    private $client;

    public function __construct(Client $client)
    {
        $this->apiBaseUrl = env('API_BASE_URL');
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $token = session('api_token');
        $userId = session('user_id');

        $response = $this->client->get("$this->apiBaseUrl/users/$userId", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $users = json_decode($response->getBody(), true);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'firstName' => $request->input('first_name'),
            'lastName' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'repeatPassword' => $request->input('password_confirmation'),
        ];

        $response = $this->client->post("$this->apiBaseUrl/users", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200) {
            return redirect()->route('users.index');
        } else {
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/users/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $user = json_decode($response->getBody(), true);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/users/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $user = json_decode($response->getBody(), true);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'firstName' => $request->input('first_name'),
            'lastName' => $request->input('last_name'),
            'email' => $request->input('email'),
        ];

        $response = $this->client->put("$this->apiBaseUrl/users/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('users.index');
        } else {
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = $this->client->delete("$this->apiBaseUrl/users/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('users.index');
        } else {
            return back()->withInput();
        }
    }
}
