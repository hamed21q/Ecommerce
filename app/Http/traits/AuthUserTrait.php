<?php
namespace App\Http\Traits;


use phpDocumentor\Reflection\Types\Boolean;
use illuminate\Support\Facades\Auth;

trait AuthUserTrait
{
    public static function hasRole(int $role)
    {
        if(auth()->user()->role_id == $role)
        {
            return true;
        }
        return false;
    }
}