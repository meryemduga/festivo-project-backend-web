<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'name' => 'Admin Festivo',
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'is_admin' => true,
        ]);

       
        $cat = FaqCategory::create(['name' => 'Tickets & Toegang']);
        FaqItem::create([
            'faq_category_id' => $cat->id,
            'question' => 'Hoe ontvang ik mijn e-tickets?',
            'answer' => 'Na je reservering ontvang je de e-tickets direct per e-mail.',
        ]);

        
        $event = Event::create([
            'title' => 'Festivo Opening Night 2026',
            'content' => 'Het grootste openingsfeest van het seizoen in hartje Brussel.',
            'published_at' => now(),
        ]);
        $tag = Tag::create(['name' => 'Festival']);
        $event->tags()->attach($tag->id);
    }
}