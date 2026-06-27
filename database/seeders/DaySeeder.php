<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        Day::insert([
        ['name' => 'Dushanba', 'name_ru' => 'Понедельник'],
        ['name' => 'Seshanba', 'name_ru' => 'Вторник'],
        ['name' => 'Chorshanba', 'name_ru' => 'Среда'],
        ['name' => 'Payshanba', 'name_ru' => 'Четверг'],
        ['name' => 'Juma', 'name_ru' => 'Пятница'],
        ['name' => 'Shanba', 'name_ru' => 'Суббота'],
       
]);
    }
}
