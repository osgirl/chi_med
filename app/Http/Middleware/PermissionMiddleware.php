<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next , $role)
      {
        if (!$this->check($role)) {
            return view('errors/unauthorized');
        }
        return $next($request);
      }

      private function check($role)
      {
        $check = User::select($role)->where('id','=', Auth::id())->first();
        if($check->$role == true){
          return true;
        }else{
          return false;
        }
    }
}
