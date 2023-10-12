<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TvInfo;

class TvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tv1    =   [
            'route' => 'https://tortasdelauravzla.com/storage/video1.mp4',
            'type' => 'video',
            'showIn' => 1
        ];
        $tv2    =   [
            'route' => 'https://tortasdelauravzla.com/storage/video1.mp4',
            'type' => 'video',
            'showIn' => 2
        ];
        TvInfo::create($tv1);
        TvInfo::create($tv2);
    }
}
