<?php 

namespace App\Repositories;

use App\Models\Shirt;
use App\Repositories\Contracts\ShirtRepositoryInterface;

class ShirtRepository implements ShirtRepositoryInterface
{
    public function getPopularShirt($limit = 4)
    {
        return Shirt::where('is_popular', true)->take($limit)->get();
    }

    public function getAllNewShirt()
    {
        return Shirt::latest()->get();
    }

    public function searchByName(string $keyword)
    {
        return Shirt::where('name', 'LIKE', '%' . $keyword . '%')->get();
    }

    public function find($id){
        return Shirt::find($id);
    }

    public function getPrice($shirtId)
    {
        $shirt = $this->find($shirtId);
        return $shirt ? $shirt->price : 0;
    }
}