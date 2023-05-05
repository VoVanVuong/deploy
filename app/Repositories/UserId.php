<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class UserId implements UserInterface
{
    public function returnUserId()
    {
        return Auth::guard('api')->user()->id;
    }
}
