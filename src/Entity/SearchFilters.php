<?php

namespace App\Entity;

use App\Repository\SearchFiltersRepository;
use Doctrine\ORM\Mapping as ORM;


class SearchFilters
{

    private $id;


    private $categories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories(): ?object
    {
        return $this->categories;
    }

    public function setCategories(object $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
