<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Politik', 'Ekonomi', 'Sosial', 'Teknologi',
            'Olahraga',
        ];
        foreach ($categories as $caterory) {
            CategoryModel::create([
                'name' => $caterory,
            ]);
        }
    }
}
