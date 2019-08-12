<?php

namespace App\Observers;

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
    public function saving(Role $role)
    {
        if(empty($role->slug)){
            $role->slug = strtolower( $role->name );
        }
    }
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function creating(Role $role)
    {

    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function updating(Role $role)
    {
    }
    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Role  $translado
     * @return void
     */
    public function deleting(Role $role)
    {
    }
    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
