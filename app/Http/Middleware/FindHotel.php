<?php

namespace App\Http\Middleware;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Hotel;
use Closure;
use Illuminate\Http\Request;

class FindHotel
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
        // get the hotel id from route
        $hotelId = $request->hotelId;

        // check if the hotel is exists by the given id
        if (!($hotel = Hotel::find($hotelId))) {
            throw new ResourceNotFoundException();
        }

        // pass the hotel to the request if it were found
        $request->merge(['hotel' => $hotel]);

        return $next($request);

    }
}
