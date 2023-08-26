<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrganizerController extends Controller
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

        $response = $this->client->get("$this->apiBaseUrl/organizers?page=$page&perPage=$perPage", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $organizers = json_decode($response->getBody(), true);

        return view('organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('organizers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'organizerName' => $request->input('name'),
            'imageLocation' => $request->input('image'),
        ];

        $response = $this->client->post("$this->apiBaseUrl/organizers", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/organizers/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $organizer = json_decode($response->getBody(), true);

        return view('organizers.show', compact('organizer'));
    }

    public function edit($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/organizers/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $organizer = json_decode($response->getBody(), true);

        return view('organizers.edit', compact('organizer'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input using Laravel's validation rules
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'organizerName' => $request->input('name'),
            'imageLocation' => $request->input('image'),
        ];

        $response = $this->client->put("$this->apiBaseUrl/organizers/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = $this->client->delete("$this->apiBaseUrl/organizers/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }
}
