<?php

namespace App\Http\Middleware;

use App\Exceptions\ResourceNotFoundException;
use App\Models\RoomType;
use Closure;
use Illuminate\Http\Request;

class FindRoomType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // get the roomType id from route
        $roomTypeId = $request->roomTypeId;

        // check if the roomType is exists by the given id
        if (!($roomType = RoomType::find($roomTypeId))) {
            throw new ResourceNotFoundException();
        }

        // pass the roomType to the request if it were found
        $request->merge(['roomType' => $roomType]);

        return $next($request);
    }
}
