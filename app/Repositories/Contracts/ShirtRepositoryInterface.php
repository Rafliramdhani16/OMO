<?php 

namespace App\Repositories\Contracts;

interface ShirtRepositoryInterface
{
    public function getPopularShirt($limit);

    public function getAllNewShirt();

    public function searchByName(string $keyword);

    public function find($id);

    public function getPrice($ticketId);
}