<?php

namespace Database\Seeders;

use App\Models\ContactUsCms;
use Illuminate\Database\Seeder;

class AddContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new ContactUsCms();
        $data->title = 'Get in touch';
        $data->description = "Now we are engaged for some time, let's get connected";
        $data->visit_us = 'Lorem sec 5 USA';
        $data->call_us = '+1 1234 567 890';
        $data->mail_us = 'whiteglovecomics@gmail.com';
        $data->save();
    }
}
 