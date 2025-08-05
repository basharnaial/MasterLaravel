<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Collection;

class BlogService
{


    public function getAll(): Collection
    {
        return Blog::all();
    }

    public function store(array $data): Blog
    {
        return Blog::create($data);
    }
    public function update(Blog $blog, array $data): Blog
    {
        // Unlike create(), update() does not return the updated model — it returns a boolean (true/false).
        // So we first perform the update, then explicitly return the $blog model itself.
        $blog->update($data);

        return $blog;
    }

    public function destroy(Blog $blog): bool
    {

        try {
            $blog->delete();

            return true;
        } catch (Exception $e) {
            return false;
        }

    }
}
