<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $data = $this->homeService->home();
        return view('frontend.home.home', $data);
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
        ]);

        $this->homeService->generalReview($validated);

        return back()->with('success', 'Terima kasih! Ulasan Anda telah dikirim.');
    }
}
