<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Http\Resources\PriceCollection;
use App\Http\Resources\PriceResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomType = $request->roomType;
        $roomTypePrices = Price::where('room_type_id', $roomType->id)->get();

        return response()->json(new PriceCollection($roomTypePrices), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRequest $request)
    {
        $roomType = $request->roomType;
        $roomTypePrice = Price::create([
            'room_type_id' => $roomType->id,
            'price' => $request->price,
            'date' => $request->date,
        ]);

        return response()->json(new PriceResource($roomTypePrice), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $roomTypePrice = $request->roomTypePrice;
        return response()->json(new PriceResource($roomTypePrice), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceRequest $request)
    {
        $roomTypePrice = $request->roomTypePrice;

        $roomTypePrice->price = $request->price;
        $roomTypePrice->date = $request->date;
        $roomTypePrice->save();

        return response()->json(new PriceResource($roomTypePrice), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $roomTypePrice = $request->roomTypePrice;
        $roomTypePrice->delete();

        return response()->json(['message' => 'Resource deleted'], Response::HTTP_OK);
    }
}
