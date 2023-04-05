<?php

namespace Database\Seeders;

use App\Models\HomeCms;
use Illuminate\Database\Seeder;

class addHomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = new HomeCms();
        $home->banner_title = 'Find Your Next';
        $home->banner_description = 'Our most popular and trending White Glove Comics & KCI. perfect Not sure what to read now next reading mood perfectly.';
        $home->section_2_image = 'home/banner2.png';
        $home->section_2_title = 'Present the "Gods & Monsters" Collection';
        $home->section_3_image = 'home/banner3.png';
        $home->section_3_title = 'Online Book Fairs 2022';
        $home->section_3_description = 'Lorem ipsum dolor sit amet consectetur. Lacus egestas odio ut enim. Mus diam rhoncus viverra varius amet tellus orci. Enim vestibulum ornare vulputate ornare egestas purus dolor.';
        $home->save();
    }
}
