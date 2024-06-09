<?php

namespace App\Interface\Repository;

interface AdminRepositoryInterface
{
    public function findByEmail(string $email);
}
