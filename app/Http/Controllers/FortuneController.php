<?php

namespace App\Http\Controllers;

use App\Models\Fortune;
use Symfony\Component\HttpFoundation\Request;

class FortuneController extends Controller
{
    public function index()
    {
        return 'hello fortune';
    }

    public function show(Request $request)
    {
        $birthday = new \DateTimeImmutable($request->query->get('birthday'));
        $birthdayValue = (int) $birthday->format('nd');

        $signs = [
            '牡羊座' => [
                [321, 419],
            ],
            '牡牛座' => [
                [420, 520],
            ],
            '双子座' => [
                [521, 621],
            ],
            '蟹座' => [
                [622, 722],
            ],
            '獅子座' => [
                [723, 822],
            ],
            '乙女座' => [
                [823, 922],
            ],
            '天秤座' => [
                [923, 1023],
            ],
            '蠍座' => [
                [1024, 1122],
            ],
            '射手座' => [
                [1123, 1221],
            ],
            '山羊座' => [
                [1222,1231],
                [101, 119],
            ],
            '水瓶座' => [
                [120, 218],
            ],
            '魚座' => [
                [219, 320],
            ],
        ];

        $targetSign = null;
        foreach ($signs as $name => $specs) {
            foreach ($specs as $spec) {
                if ($birthdayValue >= $spec[0] && $birthdayValue <= $spec[1]) {
                    $targetSign = $name;
                    break 2;
                }
            }
        }
        abort_unless($targetSign, 400);

        $fortune = Fortune::query()->where('target_date', date('Y-m-d'))->where('target_sign', $targetSign)->get()->first();
        abort_unless($fortune, 400);

        return view('fortune.show', [
            'fortune' => $fortune,
        ]);
    }
}
