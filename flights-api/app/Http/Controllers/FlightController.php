<?php

namespace App\Http\Controllers;

use App\Models\FlightSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
        /*    public function index(Request $request)
    {
        $origin = $request->query('origin', 'MNL-sky');
        $destination = $request->query('destination', 'CEB-sky');
        $date = $request->query('date', '2024-06-15');

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('SKYSCANNER_API_KEY'),
            'X-RapidAPI-Host' => 'skyscanner89.p.rapidapi.com'
        ])->get('https://skyscanner89.p.rapidapi.com/search', [
            'adults' => '1',
            'origin' => $origin,
            'destination' => $destination,
            'departureDate' => $date,
            'currency' => 'USD'
        ]);

        return response()->json(json_decode($response->body()));
    }*/
    public function index()
    {
        $flights = FlightSearch::all();  // Get all records from the DB
        return response()->json($flights);
    }

    public function search(Request $request)
    {
        $origin = $request->query('origin', 'MNL-sky');
        $destination = $request->query('destination', 'CEB-sky');
        $date = $request->query('date', '2024-06-15');

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('SKYSCANNER_API_KEY'),
            'X-RapidAPI-Host' => 'skyscanner89.p.rapidapi.com'
        ])->get('https://skyscanner89.p.rapidapi.com/search', [
            'adults' => '1',
            'origin' => $origin,
            'destination' => $destination,
            'departureDate' => $date,
            'currency' => 'USD'
        ]);

        return response()->json(json_decode($response->body()));
    }

    public function show($id)
    {
        $flight = FlightSearch::find($id);

        if (!$flight) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($flight);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'origin' => 'required',
            'destination' => 'required',
            'departure_date' => 'required|date',
        ]);

        $flight = FlightSearch::create([
            'origin' => $request->input('origin'),
            'destination' => $request->input('destination'),
            'departure_date' => $request->input('departure_date'),
        ]);

        return response()->json($flight, 201);
    }

    public function update($id, Request $request)
    {
        $flight = FlightSearch::findOrFail($id);

        $flight->update($request->only(['origin', 'destination', 'departure_date']));

        return response()->json(['message' => "Flight search $id updated", 'data' => $flight]);
    }

    public function destroy($id)
    {
        $flight = FlightSearch::findOrFail($id);
        $flight->delete();

        return response()->json(['message' => "Flight search $id deleted"]);
    }

}