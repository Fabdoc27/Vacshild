<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VaccineCenterFactory extends Factory
{
    public function definition(): array
    {
        $centers = [
            'Dhaka', 'Barishal', 'Chattogram', 'Khulna', 'Mymensingh', 'Rajshahi', 'Rangpur', 'Sylhet',
        ];

        $center = fake()->unique()->randomElement($centers);

        return [
            'name' => $center,
        ];
    }
}
