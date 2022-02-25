<?php

namespace App\Http\Middleware;

use App\Exceptions\ResourceNotFoundException;
use App\Models\Price;
use Closure;
use Illuminate\Http\Request;

class FindPrice
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
        // get the price id from route
        $roomType = $request->roomType;
        $priceId = $request->priceId;

        // check if the price is exists by the given id
        if (!($price = Price::where('room_type_id', $roomType->id)->where('id', $priceId)->first())) {
            throw new ResourceNotFoundException();
        }

        // pass the price to the request if it were found
        $request->merge(['roomTypePrice' => $price]);

        return $next($request);
    }
}
