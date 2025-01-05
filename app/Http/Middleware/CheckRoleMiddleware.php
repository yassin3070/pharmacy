<?php

namespace App\Http\Middleware;

use App\Traits\AdminFirstRouteTrait;
use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CheckRoleMiddleware {
  use ApiResponseTrait, AdminFirstRouteTrait;

  public function handle($request, Closure $next) {
     $permissions = auth()->user()->roles()->first()->permissions()->pluck('name')->toArray();
     if (!in_array(Route::currentRouteName(), $permissions)) {
      $msg = trans('auth.not_authorized');
      if ($request->ajax()) {
        return $this->unauthorizedReturn(['type' => 'notAuth']);
      }

      if (!count($permissions)) {
        session()->invalidate();
        session()->regenerateToken();
        return redirect(route('show.login'));
      }

      session()->flash('danger', $msg);

      return redirect()->route($this->getAdminFirstRouteName($permissions));
      
    }

    return $next($request);
  }
}
