<?php

namespace App\Http\Middleware;

use App\Models\CardTrack;
use App\Models\Inspection;
use App\Models\TrackReport;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use ReflectionClass;


class RedirectUnauthorized
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
        /*if (Auth::check() && (Auth::user()->hasAnyRole(['Admin', 'CorporativoKP', 'Coordinador']))) {
            return $next($request);
        }
        return redirect('menu')->with('error', 'No tienes permisos para acceder a este recurso.');*/
        $user = Auth::user();

        $controllerAction = $request->route()->getAction('controller');
        $className = strtok($controllerAction, '@');

        $controllerInstance = new $className;

        $reflectionClass = new ReflectionClass($controllerInstance);
        $modelProperty = $reflectionClass->getProperty('model');
        $modelProperty->setAccessible(true);
        $model = $modelProperty->getValue($controllerInstance);

        if ($user->hasAnyRole(['Admin', 'CorporativoKP', 'Coordinador'])) {
            return $next($request);
        } elseif ($user->hasRole('Supervisor') && (app($model) instanceof Inspection || app($model) instanceof CardTrack || app($model) instanceof TrackReport)) {
            return $next($request);
        } elseif ($user->hasRole('InspectorKP') && app($model) instanceof Inspection) {
            return $next($request);
        } else {
            return redirect('/menu')->with('error', 'No tienes permisos para acceder a este recurso.');
        }


    }
}
