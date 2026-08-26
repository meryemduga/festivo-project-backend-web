<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Gebruiker
        User::updateOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('Password!321'),
                'is_admin' => true,
            ]
        );

        // 2. Test Events
        Event::create([
            'title' => 'Festivo Zomerfestival 2026',
            'content' => 'Het leukste festival van het jaar in Brussel!',
            'published_at' => now(),
        ]);

        // 3. FAQ Categorie & Item
        $cat = FaqCategory::create(['name' => 'Algemeen']);
        FaqItem::create([
            'faq_category_id' => $cat->id,
            'question' => 'Hoe kan ik tickets kopen?',
            'answer' => 'Tickets zijn direct via het platform of aan de kassa verkrijgbaar.',
        ]);
    }
}