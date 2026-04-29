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
}
