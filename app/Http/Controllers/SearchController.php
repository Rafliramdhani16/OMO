<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\SearchRepositoryInterface;

class SearchController extends Controller
{
    protected $searchRepository;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = $this->searchRepository->search($query);

        return response()->json($results);
    }
}