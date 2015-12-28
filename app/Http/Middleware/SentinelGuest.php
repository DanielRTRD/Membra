<?php namespace Membra\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelGuest {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Sentinel::check())
		{
			return new RedirectResponse(url('/'));
		}

		return $next($request);
	}

}
