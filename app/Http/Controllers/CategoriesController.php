<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Http\Response;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    protected $categoryService;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryRepository $repository, CategoryService $categoryService)
    {
        $this->repository = $repository;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->repository->all();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $categories
            ]);
        }

        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     *
     * @return Response
     *
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = $this->categoryService->create($request->all());
        if ($category === null) {
            return 'error';
        }

        return ($category->id);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $category,
            ]);
        }

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->get()->first();

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        return $category = $this->categoryService->update($request->all());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Category deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Category deleted.');
    }
}
