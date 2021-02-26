<?php

namespace App\Http\Controllers;

use App\Domain\ShowFortuneException;
use App\Domain\ShowFortuneUseCase;
use App\Models\Fortune;
use Symfony\Component\HttpFoundation\Request;

class FortuneController extends Controller
{
    /**
     * @var ShowFortuneUseCase
     */
    private $showFortuneUseCase;

    /**
     * FortuneController constructor.
     * @param ShowFortuneUseCase $showFortuneUseCase
     */
    public function __construct(ShowFortuneUseCase $showFortuneUseCase)
    {
        $this->showFortuneUseCase = $showFortuneUseCase;
    }

    public function index()
    {
        return view('fortune.index');
    }

    public function show(Request $request)
    {
        $birthday = new \DateTimeImmutable($request->query->get('birthday'));

        try {
            $fortune = $this->showFortuneUseCase->showFortune($birthday);
        } catch (ShowFortuneException $e) {
            abort(400);
        }

        return view('fortune.show', [
            'fortune' => $fortune,
        ]);
    }
}
