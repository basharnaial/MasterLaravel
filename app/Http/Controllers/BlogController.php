<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{


    private BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        // $this to access any attribute inside the class we need to use it
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogService->getAll();
        return $this->successResponse($blogs);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {

        $blog = $this->blogService->store($request->validated());
        return $this->successResponse($blog, 'Blog created successfully.', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return $this->successResponse($blog, 'Blog retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {

        $blog = $this->blogService->update($blog, $request->validated());

        return $this->successResponse($blog, 'Blog updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Blog $blog)
    {
        $deleted = $this->blogService->destroy($blog);
        if ($deleted) {
            return $this->successResponse(null, 'blog deleted successfully.');
        }

        return $this->errorResponse('Failed to delete blog', 500);

    }

}
