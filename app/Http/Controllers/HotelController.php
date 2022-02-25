<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotels = Hotel::all();
        return response()->json(new HotelCollection($hotels), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create([
            'hotel_name' => $request->hotel_name,
            'address' => $request->address,
        ]);
        
        return response()->json(new HotelResource($hotel), Response::HTTP_CREATED);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $hotel = $request->hotel;
        return response()->json(new HotelResource($hotel), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelRequest $request)
    {
        $hotel = $request->hotel;

        $hotel->hotel_name = $request->hotel_name;
        $hotel->address = $request->address;
        $hotel->save();
        
        return response()->json(new HotelResource($hotel), Response::HTTP_OK);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hotel = $request->hotel;
        $hotel->delete();

        return response()->json(['message' => 'Resource deleted'], Response::HTTP_OK);
    }
}
