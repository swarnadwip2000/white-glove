<?php

namespace Database\Seeders;

use App\Models\AboutCms;
use Illuminate\Database\Seeder;

class AddAbouPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new AboutCms();
        $about->banner_name = 'ABOUT';
        $about->section_1_img = 'about/about1.jpg';
        $about->section_1_name = 'About Us';
        $about->section_1_title = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim.';
        $about->section_1_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi. Proin dui non, risus tincidunt. Nunc id sollicitudin diam aliquet volutpat nam rhoncus morbi. Non sit ac pulvinar commodo tincidunt magnis nascetur. Scelerisque eget accumsan eget nisl vestibulum, tristique praesent tempus eget. Vestibulum viverra ut dapibus aliquam nunc auctor. Orci ultrices pellentesque sed ultricies ipsum quis neque, elementum. Enim donec sed pellentesque aliquet mi ultricies turpis non maecenas. Purus aliquet iaculis amet, vel eleifend ut elit. Vulputate amet, metus purus aenean sapien tempor, neque turpis risus. Egestas id urna ultrices dignissim.Libero aenean vestibulum placerat ultrices nullam. Semper sit ac a iaculis et morbi mattis. Pellentesque lacus, id semper id lectus ac. Dui elit pellentesque at mi quam tincidunt praesent a. Condimentum pretium aliquet aenean eu tincidunt vitae. Ac auctor sapien pretium in. Egestas metus pulvinar eu eu maecenas et. Vel fringilla quam mattis mollis vitae eu. Scelerisque dignissim turpis urna egestas suspendisse eget non. Egestas mattis felis platea sed in morbi aliquam.';
        $about->section_2_banner = 'about/about2.png';
        $about->section_2_title = 'Present the "Gods & Monsters" Collection';
        $about->section_3_img = 'about/about3.jpg';
        $about->section_3_name = 'Mission & Vision';
        $about->section_3_title = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna.';
        $about->section_3_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi. Proin dui non, risus tincidunt. Nunc id sollicitudin diam aliquet volutpat nam rhoncus morbi. Non sit ac pulvinar commodo tincidunt magnis nascetur. Scelerisque eget accumsan eget nisl vestibulum, tristique praesent tempus eget. Vestibulum viverra ut dapibus aliquam nunc auctor. Orci ultrices pellentesque sed ultricies ipsum quis neque, elementum. Enim donec sed pellentesque aliquet mi ultricies turpis non maecenas. Purus aliquet iaculis amet, vel eleifend ut elit. Vulputate amet, metus purus aenean sapien tempor, neque turpis risus. Egestas id urna ultrices dignissim.Libero aenean vestibulum placerat ultrices nullam. Semper sit ac a iaculis et morbi mattis. Pellentesque lacus, id semper id lectus ac. Dui elit pellentesque at mi quam tincidunt praesent a. Condimentum pretium aliquet aenean eu tincidunt vitae. Ac auctor sapien pretium in. Egestas metus pulvinar eu eu maecenas et. Vel fringilla quam mattis mollis vitae eu. Scelerisque dignissim turpis urna egestas suspendisse eget non. Egestas mattis felis platea sed in morbi aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et mauris enim, viverra convallis blandit facilisi eget id urna. Consequat cursus donec in diam pellentesque imperdiet elit. Et sagittis, morbi non adipiscing malesuada nibh diam quam. Arcu, et convallis arcu in mi. Proin dui non, risus tincidunt. Nunc id sollicitudin diam aliquet volutpat nam rhoncus morbi. Non sit ac pulvinar commodo tincidunt magnis nascetur. Scelerisque eget accumsan eget nisl vestibulum, tristique praesent tempus eget. Vestibulum viverra ut dapibus aliquam nunc auctor. Orci ultrices pellentesque sed ultricies ipsum quis neque, elementum. Enim donec sed pellentesque aliquet mi ultricies turpis non maecenas. Purus aliquet iaculis amet, vel eleifend ut elit. Vulputate amet, metus purus aenean sapien tempor, neque turpis risus. Egestas id urna ultrices dignissim.Libero aenean vestibulum placerat ultrices nullam. Semper sit ac a iaculis et morbi mattis. Pellentesque lacus, id semper id lectus ac. Dui elit pellentesque at mi quam tincidunt praesent a. Condimentum pretium aliquet aenean eu tincidunt vitae. Ac auctor sapien pretium in. Egestas metus pulvinar eu eu maecenas et. Vel fringilla quam mattis mollis vitae eu. Scelerisque dignissim turpis urna egestas suspendisse eget non. Egestas mattis felis platea sed in morbi aliquam.
                                        Libero aenean vestibulum placerat ultrices nullam. Semper sit ac a iaculis et morbi mattis. Pellentesque lacus, id semper id lectus ac. Dui elit pellentesque at mi quam tincidunt praesent a. Condimentum pretium aliquet aenean eu tincidunt vitae. Ac auctor sapien pretium in. Egestas metus pulvinar eu eu maecenas et. Vel fringilla quam mattis mollis vitae eu. Scelerisque dignissim turpis urna egestas suspendisse eget non. Egestas mattis felis platea sed in morbi aliquam.';
        $about->save();
    }
}
