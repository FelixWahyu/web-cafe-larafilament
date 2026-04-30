<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    public function catalog(Request $request)
    {
        $data = $this->catalogService->getCatalog($request->only(['search', 'category']));

        return view('frontend.catalog.catalog', $data);
    }

    public function show($slug)
    {
        $data = $this->catalogService->getDetail($slug);

        return view('frontend.catalog.detail', $data);
    }

    public function storeReview(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $this->catalogService->storeReview($validated, $slug);

        return back()->with('success', 'Terima kasih! Ulasan Anda telah dikirim.');
    }
}
