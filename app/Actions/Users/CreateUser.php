<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function create(array $data)
    {
        $user = new User();
        $user->fill($data);
        $user->password = Hash::make($user->password);
        $user->position()->associate($data['position_id']);
        $user->save();
    }
}
