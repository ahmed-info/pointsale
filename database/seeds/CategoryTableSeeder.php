<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = \App\Category::create([
            'name'=>'ahmed',
            
        ]);
        $category->attachRole('super_admin');
    }
}
