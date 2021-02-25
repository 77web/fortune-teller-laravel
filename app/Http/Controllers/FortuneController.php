<?php

namespace App\Http\Controllers;

use App\Domain\DecideSign;
use App\Models\Fortune;
use App\Service\FetchFortune;
use Symfony\Component\HttpFoundation\Request;

class FortuneController extends Controller
{
    /**
     * @var DecideSign
     */
    private $decideSign;

    /**
     * @var FetchFortune
     */
    private $fetchFortune;

    /**
     * FortuneController constructor.
     * @param DecideSign $decideSign
     * @param FetchFortune $fetchFortune
     */
    public function __construct(
        DecideSign $decideSign,
        FetchFortune $fetchFortune
    )
    {
        $this->decideSign = $decideSign;
        $this->fetchFortune = $fetchFortune;
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

        $fortune = $this->fetchFortune->fetchTodaysFortune($targetSign);
        abort_unless($fortune, 400);

        return view('fortune.show', [
            'fortune' => $fortune,
        ]);
    }
}
