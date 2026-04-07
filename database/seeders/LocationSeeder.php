<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // Governorates
        // =========================

        $north = Location::create([
            'name' => [
                'ar' => 'شمال غزة',
                'en' => 'North Gaza',
            ],
            'type' => 'governorate',
            'slug' => 'north-gaza',
        ]);

        $middle = Location::create([
            'name' => [
                'ar' => 'الوسطى',
                'en' => 'Middle Area',
            ],
            'type' => 'governorate',
            'slug' => 'middle-area',
        ]);

        $south = Location::create([
            'name' => [
                'ar' => 'جنوب غزة',
                'en' => 'South Gaza',
            ],
            'type' => 'governorate',
            'slug' => 'south-gaza',
        ]);

        // =========================
        // Cities - North Gaza ⭐️
        // =========================

        $jabalia = Location::create([
            'name' => [
                'ar' => 'جباليا',
                'en' => 'Jabalia',
            ],
            'type' => 'city',
            'parent_id' => $north->id,
            'slug' => 'jabalia',
        ]);

        $beitHanoun = Location::create([
            'name' => [
                'ar' => 'بيت حانون',
                'en' => 'Beit Hanoun',
            ],
            'type' => 'city',
            'parent_id' => $north->id,
            'slug' => 'beit-hanoun',
        ]);

        $beitLahiya = Location::create([
            'name' => [
                'ar' => 'بيت لاهيا',
                'en' => 'Beit Lahiya',
            ],
            'type' => 'city',
            'parent_id' => $north->id,
            'slug' => 'beit-lahiya',
        ]);

        // =========================
        // Areas - Jabalia ⭐️
        // =========================

        Location::create([
            'name' => [
                'ar' => 'جباليا البلد',
                'en' => 'Jabalia Town',
            ],
            'type' => 'area',
            'parent_id' => $jabalia->id,
            'slug' => 'jabalia-town',
        ]);

        Location::create([
            'name' => [
                'ar' => 'جباليا الشرقية',
                'en' => 'Jabalia East',
            ],
            'type' => 'area',
            'parent_id' => $jabalia->id,
            'slug' => 'jabalia-east',
        ]);

        Location::create([
            'name' => [
                'ar' => 'جباليا الغربية',
                'en' => 'Jabalia West',
            ],
            'type' => 'area',
            'parent_id' => $jabalia->id,
            'slug' => 'jabalia-west',
        ]);

        Location::create([
            'name' => [
                'ar' => 'أم النصر',
                'en' => 'Umm Al-Nasser',
            ],
            'type' => 'area',
            'parent_id' => $jabalia->id,
            'slug' => 'umm-al-nasser',
        ]);

        // =========================
        // Areas - Beit Hanoun ⭐️
        // =========================

        Location::create([
            'name' => [
                'ar' => 'بيت حانون البلد',
                'en' => 'Beit Hanoun Town',
            ],
            'type' => 'area',
            'parent_id' => $beitHanoun->id,
            'slug' => 'beit-hanoun-town',
        ]);

        Location::create([
            'name' => [
                'ar' => 'المنطقة الشرقية',
                'en' => 'Eastern Zone',
            ],
            'type' => 'area',
            'parent_id' => $beitHanoun->id,
            'slug' => 'eastern-zone-beit-hanoun',
        ]);

        // =========================
        // Areas - Beit Lahiya ⭐️
        // =========================

        Location::create([
            'name' => [
                'ar' => 'بيت لاهيا البلد',
                'en' => 'Beit Lahiya Town',
            ],
            'type' => 'area',
            'parent_id' => $beitLahiya->id,
            'slug' => 'beit-lahiya-town',
        ]);

        Location::create([
            'name' => [
                'ar' => 'حي الشجاعية',
                'en' => 'Shuja\'iyya District',
            ],
            'type' => 'area',
            'parent_id' => $beitLahiya->id,
            'slug' => 'shujayya-district',
        ]);

        // =========================
        // Cities - Middle Area
        // =========================

        $deirAlBalah = Location::create([
            'name' => [
                'ar' => 'دير البلح',
                'en' => 'Deir Al-Balah',
            ],
            'type' => 'city',
            'parent_id' => $middle->id,
            'slug' => 'deir-al-balah',
        ]);

        $nuseirat = Location::create([
            'name' => [
                'ar' => 'النصيرات',
                'en' => 'Nuseirat',
            ],
            'type' => 'city',
            'parent_id' => $middle->id,
            'slug' => 'nuseirat',
        ]);

        $maghazi = Location::create([
            'name' => [
                'ar' => 'المغازي',
                'en' => 'Al-Maghazi',
            ],
            'type' => 'city',
            'parent_id' => $middle->id,
            'slug' => 'al-maghazi',
        ]);

        // =========================
        // Areas - Deir Al-Balah
        // =========================

        Location::create([
            'name' => [
                'ar' => 'البلد',
                'en' => 'Al-Balad',
            ],
            'type' => 'area',
            'parent_id' => $deirAlBalah->id,
            'slug' => 'al-balad-deir-al-balah',
        ]);

        Location::create([
            'name' => [
                'ar' => 'البركة',
                'en' => 'Al-Baraka',
            ],
            'type' => 'area',
            'parent_id' => $deirAlBalah->id,
            'slug' => 'al-baraka',
        ]);

        // =========================
        // Cities - South Gaza
        // =========================

        $khanYounis = Location::create([
            'name' => [
                'ar' => 'خانيونس',
                'en' => 'Khan Younis',
            ],
            'type' => 'city',
            'parent_id' => $south->id,
            'slug' => 'khan-younis',
        ]);

        // =========================
        // Areas - Khan Younis
        // =========================

        Location::create([
            'name' => [
                'ar' => 'البلد',
                'en' => 'Downtown',
            ],
            'type' => 'area',
            'parent_id' => $khanYounis->id,
            'slug' => 'downtown-khan-younis',
        ]);

        Location::create([
            'name' => [
                'ar' => 'المواصي',
                'en' => 'Al-Mawasi',
            ],
            'type' => 'area',
            'parent_id' => $khanYounis->id,
            'slug' => 'al-mawasi',
        ]);

        Location::create([
            'name' => [
                'ar' => 'القرارة',
                'en' => 'Al-Qarara',
            ],
            'type' => 'area',
            'parent_id' => $khanYounis->id,
            'slug' => 'al-qarara',
        ]);
    }
}
