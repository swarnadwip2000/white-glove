<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class AddCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_array = [
            
            ['name' => 'The Secret Hideout. - (Home Decor)',
                'slug' => 'Home Decor',
                'meta_title' => 'Home Decor',
                'meta_description' => 'Home Decor',
                'status' => 1,
                'main' => 1,   
            ],
            [
                'name' => 'Comics - The Silver Age - (1956-1969)',
                'slug' => 'Comics - The Silver Age',
                'meta_title' => 'Comics - The Silver Age',
                'meta_description' => 'Comics - The Silver Age',
                'status' => 1,
                'main' => 1,          
            ],       
            [
                'name' => 'Comics- The Bronze Age (1970 - 1983)',
                'slug' => 'Comics- The Bronze Age',
                'meta_title' => 'Comics- The Bronze Age',
                'meta_description' => 'Comics- The Bronze Age',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'Comics - The Modern Age (1992 - Present)',
                'slug' => 'Comics - The Modern Age',
                'meta_title' => 'Comics - The Modern Age',
                'meta_description' => 'Comics - The Modern Age',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'Superhero Capes, Boots, And Bracelets - (Apparel)',
                'slug' => 'Superhero Capes, Boots, And Bracelets',
                'meta_title' => 'Superhero Capes, Boots, And Bracelets',
                'meta_description' => 'Superhero Capes, Boots, And Bracelets',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'The Utility Belt - (Tech)',
                'slug' => 'The Utility Belt',
                'meta_title' => 'The Utility Belt',
                'meta_description' => 'The Utility Belt',
                'status' => 1,
                'main' => 1,          
            ],
            
        ];

        foreach ($category_array as $key => $value) {
            Category::create($value);
        }
    }
}
