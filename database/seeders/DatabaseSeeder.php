<?php

namespace Database\Seeders;

use App\Models\Fortune;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $signs = [
            '牡羊座',
            '牡牛座',
            '双子座',
            '蟹座',
            '獅子座',
            '乙女座',
            '天秤座',
            '蠍座',
            '射手座',
            '山羊座',
            '水瓶座',
            '魚座',
        ];
        foreach ($signs as $sign) {
            Fortune::create([
                'target_sign' => $sign,
                'fortune_text' => $sign.'の運勢は最高です',
                'target_date' => date('Y-m-d'),
            ]);
        }
    }
}
