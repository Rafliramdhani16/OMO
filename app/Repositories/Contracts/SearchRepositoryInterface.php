<?php

namespace App\Repositories\Contracts;

interface SearchRepositoryInterface
{
    public function search(string $query);
}