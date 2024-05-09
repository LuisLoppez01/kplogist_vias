<?php

namespace App\Policies;


use App\Models\CardTrack;
use App\Models\Inspection ;
use App\Models\TrackReport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class   RouteAccessPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, $model)
    {
        //return $user->hasAnyRole(['Admin', 'CorporativoKP','Coordinador']);
        if ($user->hasAnyRole(['Admin', 'CorporativoKP', 'Coordinador'])) {
            return true;
        } elseif ($user->hasRole('Supervisor')) {

            return app($model) instanceof Inspection || app($model) instanceof CardTrack || app($model) instanceof TrackReport ;
        } elseif ($user->hasRole('InspectorKP')) {
            return app($model) instanceof Inspection && request()->method()=='GET' || request()->method()=='POST';
        } else {
            return false; // Denegar acceso por defecto
        }
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['Admin', 'CorporativoKP']);
    }

    public function update(User $user)
    {
        return $user->hasAnyRole(['Admin', 'CorporativoKP']);
    }

    public function delete(User $user)
    {
        return $user->hasAnyRole(['Admin', 'CorporativoKP'])
            ? true
            : throw new AuthorizationException('No tiene permiso para eliminar este recurso.');
    }
}
