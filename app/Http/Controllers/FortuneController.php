<?php

namespace App\Http\Controllers;

use App\Domain\DecideSign;
use App\Models\Fortune;
use Symfony\Component\HttpFoundation\Request;

class FortuneController extends Controller
{
    /**
     * @var DecideSign
     */
    private $decideSign;

    /**
     * FortuneController constructor.
     * @param DecideSign $decideSign
     */
    public function __construct(
        DecideSign $decideSign
    )
    {
        $this->decideSign = $decideSign;
    }


    public function index()
    {
        return view('fortune.index');
    }

    public function show(Request $request)
    {
        $birthday = new \DateTimeImmutable($request->query->get('birthday'));

        $targetSign = $this->decideSign->decideSign($birthday);
        abort_unless($targetSign, 400);

        $fortune = Fortune::query()->where('target_date', date('Y-m-d'))->where('target_sign', $targetSign)->get()->first();
        abort_unless($fortune, 400);

        return view('fortune.show', [
            'fortune' => $fortune,
        ]);
    }
}
