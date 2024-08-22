<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class PageCounter
{
    public function __construct(
        public LengthAwarePaginator $paginator
    ) {}

    public function getTotal(): ?int
    {
        return $this->paginator->total();
    }

    private function getLeftBorder(): ?int
    {
        $counter = $this->paginator->currentPage() - 1;
        return 1 + $this->paginator->perPage() * $counter;
    }

    private function getRightBorder(): ?int
    {
        switch (true) {
            case $this->paginator->currentPage() == $this->paginator->lastPage():
                return $this->paginator->total();
        }

        return $this->paginator->perPage() * $this->paginator->currentPage();
    }
}
