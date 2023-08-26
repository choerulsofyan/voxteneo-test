<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apiBaseUrl = env('API_BASE_URL');
        $page = $request->page ? $request->page : 1;
        $perPage = $request->perPage ? $request->perPage : 10;
        $token = session('api_token');

        // Send the login request to the external API using Guzzle
        $client = new Client();
        $response = $client->get($apiBaseUrl . '/organizers?page=' . $page . '&perPage=' . $perPage, [
            'headers' => ['Content-type' => 'application/json'],
            'headers' => ['Authorization' => "Bearer $token"],
        ]);

        $organizers = json_decode($response->getBody(), true);

        if ($response->getStatusCode() === 200) {
        }

        return view('organizers.index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $token = session('api_token');

        $apiRequestBody = [
            'organizerName' => $request->name,
            'imageLocation' => $request->image,
        ];

        // Send the request to the external API using Guzzle
        $client = new Client();
        $response = $client->post($apiBaseUrl . '/organizers', [
            'headers' => ['Content-type' => 'application/json'],
            'headers' => ['Authorization' => "Bearer $token"],
            'json' => $apiRequestBody,
        ]);

        // Process the API response as needed
        $apiResponse = json_decode($response->getBody(), true);

        // Return a response to the user based on the API response
        if ($response->getStatusCode() === 200) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $token = session('api_token');


        // Send the request to the external API using Guzzle
        $client = new Client();
        $response = $client->get($apiBaseUrl . '/organizers/' . $id, [
            'headers' => ['Content-type' => 'application/json'],
            'headers' => ['Authorization' => "Bearer $token"]
        ]);

        // Process the API response as needed
        $organizer = json_decode($response->getBody(), true);

        // Return a response to the user based on the API response
        if ($response->getStatusCode() === 200) {
        } else {
        }

        return view('organizers.edit', compact('organizer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $token = session('api_token');

        $apiRequestBody = [
            'organizerName' => $request->name,
            'imageLocation' => $request->image,
        ];

        // Send the request to the external API using Guzzle
        $client = new Client();
        $response = $client->put($apiBaseUrl . '/organizers/' . $id, [
            'headers' => ['Content-type' => 'application/json'],
            'headers' => ['Authorization' => "Bearer $token"],
            'json' => $apiRequestBody,
        ]);


        // Process the API response as needed
        $apiResponse = json_decode($response->getBody(), true);

        // Return a response to the user based on the API response
        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apiBaseUrl = env('API_BASE_URL');

        $token = session('api_token');

        // Send the request to the external API using Guzzle
        $client = new Client();
        $response = $client->delete($apiBaseUrl . '/organizers/' . $id, [
            'headers' => ['Content-type' => 'application/json'],
            'headers' => ['Authorization' => "Bearer $token"],
        ]);

        // Process the API response as needed
        $apiResponse = json_decode($response->getBody(), true);

        // Return a response to the user based on the API response
        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 204) {
            return redirect()->route('organizers.index');
        } else {
            return back()->withInput();
        }
    }
}
