<?php


namespace App\Services;


use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SortService
{
    public function sortByCategory(Category $category): BelongsToMany
    {
        return $category->posts();
    }
}
