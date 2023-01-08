<?php

namespace App\Actions\Users;

use App\Models\User;

class CreateUser
{
    public function create(array $data)
    {
        $user = new User();
        $user->fill($data)
            ->save();
    }
}
