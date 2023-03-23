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
                'slug' => 'home-decor',
                'meta_title' => 'home-decor',
                'meta_description' => 'home-decor',
                'status' => 1,
                'main' => 1,   
            ],
            [
                'name' => 'Comics - The Silver Age - (1956-1969)',
                'slug' => 'comics-silver-age',
                'meta_title' => 'comics-silver-age',
                'meta_description' => 'comics-silver-age',
                'status' => 1,
                'main' => 1,          
            ],       
            [
                'name' => 'Comics- The Bronze Age (1970 - 1983)',
                'slug' => 'comics-bronze-age',
                'meta_title' => 'comics-bronze-age',
                'meta_description' => 'comics-bronze-age',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'Comics - The Modern Age (1992 - Present)',
                'slug' => 'comics-modern-age',
                'meta_title' => 'comics-modern-age',
                'meta_description' => 'comics-modern-age',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'Superhero Capes, Boots, And Bracelets - (Apparel)',
                'slug' => 'superhero-capes-boots-bracelets',
                'meta_title' => 'superhero-capes-boots-bracelets',
                'meta_description' => 'superhero-capes-boots-bracelets',
                'status' => 1,
                'main' => 1,          
            ],
            [
                'name' => 'The Utility Belt - (Tech)',
                'slug' => 'utility-belt',
                'meta_title' => 'utility-belt',
                'meta_description' => 'utility-belt',
                'status' => 1,
                'main' => 1,          
            ],
            
        ];

        foreach ($category_array as $key => $value) {
            Category::create($value);
        }
    }
}
