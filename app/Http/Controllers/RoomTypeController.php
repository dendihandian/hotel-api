<?php

namespace App\Http\Controllers;

use App\Exceptions\ResourceNotFound;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Http\Resources\RoomTypeCollection;
use App\Http\Resources\RoomTypeResource;
use Symfony\Component\HttpFoundation\Response;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomTypes = RoomType::all();
        return response()->json(new RoomTypeCollection($roomTypes), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomTypeRequest $request)
    {
        $roomType = RoomType::create([
            'name' => $request->name,
        ]);
        
        return response()->json(new RoomTypeResource($roomType), Response::HTTP_CREATED);
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
            $roomType = RoomType::FindOrFail($request->roomTypeId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }

        return response()->json(new RoomTypeResource($roomType), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomTypeRequest $request)
    {
        try {
            $roomType = RoomType::FindOrFail($request->roomTypeId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }

        $roomType->name = $request->name;
        $roomType->save();
        
        return response()->json(new RoomTypeResource($roomType), Response::HTTP_OK);
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
            $roomType = RoomType::FindOrFail($request->roomTypeId);
        } catch (\Throwable $th) {
            throw new ResourceNotFound();
        }
        $roomType->delete();

        return response()->json(['message' => 'Resource deleted'], Response::HTTP_OK);
    }
}
