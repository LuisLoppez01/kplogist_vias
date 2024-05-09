<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeleteDataPolicy
{
    use HandlesAuthorization;


    public function delete(User $user)
    {
        return $user->hasAnyRole(['Admin', 'CorporativoKP']);
    }
}
