<?php

namespace Database\Seeders;

use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Seeder;
use Database\Seeders\Roleseeder;
use Database\Seeders\Countriesseeder;
use Database\Seeders\Userseeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Roleseeder::class);
        $this->call(Countriesseeder::class);
        $this->call(Userseeder::class);
    }
}
