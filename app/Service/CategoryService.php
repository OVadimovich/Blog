<?php

namespace App\Service;

use App\Models\Category;

class CategoryService
{
    public function saveCategory(string $title): void
    {
        $category = new Category(
            [
                'title' => $title
            ]
        );

        $category->save();
    }
}
