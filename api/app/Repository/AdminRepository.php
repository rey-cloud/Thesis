<?php

namespace App\Repository;

use App\Interface\Repository\AdminRepositoryInterface;
use App\Interface\Repository\UserRepositoryInterface;
use App\Models\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    public function findByEmail(string $email)
    {
        return Admin::where('email', $email)->first();
    }
}  
