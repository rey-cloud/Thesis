<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name' => "Rey",
            'email' => "rey@gmail.com",
            'password' => Hash::make('password'), 
        ];
    }
}
