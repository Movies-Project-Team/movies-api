<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('languages')->insert([
            [
                'title' => 'Anh',
                'code' => 'Anh',
            ],
            [
                'title' => 'Canada',
                'code' => 'Canada',
            ],
            [
                'title' => 'Hàn Quốc',
                'code' => 'Hàn Quốc',
            ],
            [
                'title' => 'Hồng Kông',
                'code' => 'Hồng Kông',
            ],
            [
                'title' => 'Mỹ',
                'code' => 'Mỹ',
            ],
            [
                'title' => 'Nhật Bản',
                'code' => 'Nhật Bản',
            ],
            [
                'title' => 'Pháp',
                'code' => 'Pháp',
            ],
            [
                'title' => 'Thái Lan',
                'code' => 'Thái Lan',
            ],
            [
                'title' => 'Trung Quốc',
                'code' => 'Trung Quốc',
            ],
            [
                'title' => 'Úc',
                'code' => 'Úc',
            ],
            [
                'title' => 'Đức',
                'code' => 'Đức',
            ],
            [
                'title' => 'Khác',
                'code' => 'Khác',
            ],

        ]);
    }
}
