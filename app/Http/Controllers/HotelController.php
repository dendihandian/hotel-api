<?php

namespace App\Http\Controllers;

use App\Exceptions\ResourceNotFound;
use App\Http\Requests\HotelRequest;
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
    public function store(HotelRequest $request)
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
        try {
            $hotel = Hotel::FindOrFail($request->hotelId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }

        return response()->json(new HotelResource($hotel), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HotelRequest $request)
    {
        try {
            $hotel = Hotel::FindOrFail($request->hotelId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }

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
        try {
            $hotel = Hotel::FindOrFail($request->hotelId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }
        $hotel->delete();

        return response()->json(['message' => 'Resource deleted'], Response::HTTP_OK);
    }
}
