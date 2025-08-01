<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;

class BookController extends Controller
{
    // Injecting BookService into the controller using Constructor Injection.
    // # This allows us to use BookService methods inside this controller without manually creating an instance.
    // here how we can call the service? we will make constructor
    // Notes to remember:
    // - We declare the dependency (BookService) as a typed private property.
    // - Laravel's Service Container will automatically resolve and inject BookService.
    // - Methods in BookService must be public to be accessible here.
    // - Always use `$this->` to access the injected service within the controller methods.
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        // $this to access any attribute inside the class we need to use it
        $this->bookService = $bookService;
    }

    // If we didn't use Dependency Injection, we would have created a regular constructor
    // and manually instantiated the service like
    //    private BookService $bookService;
    //    public function __construct()
    //    {
    //        $this->bookService = new BookService();
    //    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //        $books = Book::all();
        $books = $this->bookService->getAll();

        return $this->successResponse($books);
    }

    /**
     * Store a newly created resource in storage.
     */

    // Validation rules are now defined in StoreBookRequest,
    // so we replace store(Request $request) with store(StoreBookRequest $request)
    // to use the custom request class instead of the default Request.
    public function store(StoreBookRequest $request)
    {
        // validation is already handled in StoreBookRequest
        $book = $this->bookService->store($request->validated());

        return $this->successResponse($book, 'Book created successfully.', 201);

    }

    /**
     * Display the specified resource.
     */

    //  طريقة غير مفضلة ولا تستخدم Route Model Binding
    // هذا الكود يعيد الكتاب باستخدام ID ويحتاج كتابة findOrFail يدويًا
    // وليس الأفضل في Laravel الحديث، لأننا نعيد اختراع العجلة
    //    public function showX(string $id)
    //    {
    //        $book  = Book::findOrFail($id);
    //
    //        return $book;
    //    }

    //  الطريقة الصحيحة باستخدام Route Model Binding
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

        $book = $this->bookService->update($book, $request->validated());

        return $this->successResponse($book, 'Book updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $deleted = $this->bookService->destroy($book);
        if ($deleted) {
            return $this->successResponse(null, 'Book deleted successfully.');
        }

        return $this->errorResponse('Failed to delete book', 500);

    }
}
