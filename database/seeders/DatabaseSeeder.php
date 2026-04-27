<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
 {
    public function run(): void
 {
        // ✅ SETTINGS ( NO DUPLICATE, SAFE UPDATE )
        Setting::updateOrCreate(
            [ 'id' => 1 ],
            [
                'about_title' => 'Software Developer',
                'about_description' => 'I am Amit Kumar Mahato, an aspiring full-stack web developer focused on Laravel and modern web technologies. I enjoy building dynamic, user-friendly applications such as admin dashboards and business management systems. I have hands-on experience with Laravel, PHP, MySQL, and frontend tools like Tailwind CSS and JavaScript. I am eager to grow my skills and contribute to real-world projects.',
                'fb_url' => 'https://www.facebook.com/p/Amit-Singh-100051858127579/',
                'github_url' => 'https://github.com/amit-kr-mahato',
                'linkedin_url' => 'https://www.linkedin.com/in/amit-singh-7a15752b4/',
                'freelance_url' => 'https://www.freelancer.com/u/amits0180',
                'cv_url' => 'https://docs.google.com/document/d/1wdEuw3VjYI3TVe3ujqbhSJ4hYY10gjytuVMCnf9vVSU/edit?tab=t.0',
                'video_url' => 'https://youtube.com/@code-tech-school',
            ]
        );

        // ✅ USER ( ONLY ONE METHOD - NO DUPLICATE )
        User::updateOrCreate(
            [ 'email' => 'singhamit984537@gmail.com' ],
            [
                'name' => 'AmitKumarMahato',
                'password' => Hash::make( 'Aaditya@1234' ),
                'is_admin' => 1,
                'email_verified_at' => now(),
            ]
        );
    }
}