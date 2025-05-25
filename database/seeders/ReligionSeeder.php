<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionSeeder extends Seeder
{
    public function run()
    {
        $religions = [
            'Islam',
            'Christianity',
            'Hinduism',
            'Buddhism',
            'Judaism',
            'Sikhism',
            'Baháʼí Faith',
            'Jainism',
            'Shinto',
            'Taoism',
            'Zoroastrianism',
            'Confucianism',
            'Paganism',
            'Spiritualism',
            'Atheism',
            'Agnosticism',
            'Rastafarianism',
            'Unitarian Universalism',
            'Scientology',
            'Animism'
        ];

        foreach ($religions as $name) {
            Religion::create(['name' => $name]);
        }
    }
}
