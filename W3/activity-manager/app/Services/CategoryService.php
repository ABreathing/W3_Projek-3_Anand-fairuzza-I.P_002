<?php

namespace App\Services;

use App\Models\Category;
use DomainException;

class CategoryService
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function delete(Category $category): void
    {
        if ($category->activities()->exists()) {
            throw new DomainException(
                "Kategori \"{$category->name}\" masih dipakai oleh kegiatan dan tidak dapat dihapus."
            );
        }

        $category->delete();
    }
}