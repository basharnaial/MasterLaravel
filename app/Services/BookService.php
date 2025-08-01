<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Collection;

class BookService
{
    // we move business logic only
    // http request and return json from controller only
    // data here will not pass as request but data
    // ############################################
    // here the names will not be index/show/create/stote
    // name should be something general like getAll()

    public function getAll(): Collection
    {
        return Book::all();
    }

    // :Book means return type
    public function update(Book $book, array $data): Book
    {
        // Unlike create(), update() does not return the updated model — it returns a boolean (true/false).
        // So we first perform the update, then explicitly return the $book model itself.
        $book->update($data);

        return $book;
    }

    public function store(array $data): Book
    {
        return Book::create($data);
    }

    public function destroy(Book $book): bool
    {

        try {
            $book->delete();

            return true;
        } catch (Exception $e) {
            return false;
        }

    }
}
