<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SportEventController extends Controller
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

        $response = $this->client->get("$this->apiBaseUrl/sport-events?page=$page&perPage=$perPage", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $sportEvents = json_decode($response->getBody(), true);

        return view('sport-events.index', compact('sportEvents'));
    }

    public function create()
    {
        return view('sport-events.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'name' => 'required',
            'type' => 'required',
            'organizer_id' => 'required|numeric',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'eventDate' => $request->input('date'),
            'eventType' => $request->input('name'),
            'eventName' => $request->input('type'),
            'organizerId' => $request->input('organizer_id'),
        ];

        $response = $this->client->post("$this->apiBaseUrl/sport-events", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200) {
            return redirect()->route('sport-events.index');
        } else {
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/sport-events/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $sportEvent = json_decode($response->getBody(), true);

        return view('sport-events.show', compact('sportEvent'));
    }

    public function edit($id)
    {
        $token = session('api_token');

        $response = $this->client->get("$this->apiBaseUrl/sport-events/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        $sportEvent = json_decode($response->getBody(), true);

        return view('sport-events.edit', compact('sportEvent'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'name' => 'required',
            'type' => 'required',
            'organizer_id' => 'required|numeric',
        ]);

        $token = session('api_token');

        $apiRequestBody = [
            'eventDate' => $request->input('date'),
            'eventType' => $request->input('name'),
            'eventName' => $request->input('type'),
            'organizerId' => $request->input('organizer_id'),
        ];

        $response = $this->client->put("$this->apiBaseUrl/sport-events/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
            'json' => $apiRequestBody,
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('sport-events.index');
        } else {
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $token = session('api_token');

        $response = $this->client->delete("$this->apiBaseUrl/sport-events/$id", [
            'headers' => [
                'Content-type' => 'application/json',
                'Authorization' => "Bearer $token",
            ],
        ]);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('sport-events.index');
        } else {
            return back()->withInput();
        }
    }
}
