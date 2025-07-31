<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        Return $books;

    }

    /**
     * Store a newly created resource in storage.
     */


    // Validation rules are now defined in StoreBookRequest,
    // so we replace store(Request $request) with store(StoreBookRequest $request)
    // to use the custom request class instead of the default Request.
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'pages' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
        ]);

        $book = Book::create($validated);
        return $this->successResponse($book, 'Book created successfully.', 201);

    }

    /**
     * Display the specified resource.
     */


    // ❌ طريقة غير مفضلة ولا تستخدم Route Model Binding
    // هذا الكود يعيد الكتاب باستخدام ID ويحتاج كتابة findOrFail يدويًا
    // وليس الأفضل في Laravel الحديث، لأننا نعيد اختراع العجلة
    public function showX(string $id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }

    // ✅ الطريقة الصحيحة باستخدام Route Model Binding
    // Laravel سيجلب الـ Book تلقائيًا، وسيتعامل مع 404 إن لم يوجد
    // الكود أنظف وأقصر ويستخدم best practices
    public function show(Book $book)
    {
        return $this->successResponse($book, 'Book retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'pages' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
        ]);

        $book->update($validated);

//        return response()->json([
//            'message' => 'Book updated successfully.',
//            'data' => $book,
//        ]);
        return $this->successResponse($book, 'Book updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        try {

            $book->delete();
            return $this->successResponse(null, 'book deleted successfully');

        } catch (\Exception $e) {

            return $this->errorResponse('failed to delete book', 500);
        }

    }
}
