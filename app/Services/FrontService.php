<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ShirtRepositoryInterface;

class FrontService
//dip injeksi
{
    protected $categoryRepository;
    protected $shirtRepository;

    public function __construct(ShirtRepositoryInterface $shirtRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->shirtRepository = $shirtRepository;
    }

    public function searchByName(string $keyword)
    {
        return $this->shirtRepository->searchByName($keyword);
    }

    public function getFrontPageData()
    {
        $category = $this->categoryRepository->getAllCategories();
        $popularShirt = $this->shirtRepository->getPopularShirt(4);
        $newShirt = $this->shirtRepository->getAllNewShirt();

        return compact('category', 'popularShirt', 'newShirt');
    }
}
