<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'excerpt' => 'Welcome to our platform',
                'content' => '',
                'is_active' => true,
                'show_in_menu' => false,
                'order' => 0,
            ]
        );
    }
}
