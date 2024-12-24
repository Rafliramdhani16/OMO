<?php

namespace App\Http\Controllers;

use App\Models\Shirt;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\FrontService;

class FrontController extends Controller
{
    //
    protected $frontService;

    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function index ()
    {
        $data = $this->frontService->getFrontPageData();
        return view('front.index', $data);
    }

    public function details(Shirt $shirt)
    {
        return view ('front.details', compact('shirt'));
    }

    public function category(Category $category)
    {
        return view('front.category', compact('category'));
    }
    public function allShirts()
    {
        $shirts = $this->frontService->getAllShirts();
        return view('front.shirt-all', compact('shirts'));
    }
}
