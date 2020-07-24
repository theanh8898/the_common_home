<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        DB::beginTransaction();
        try {
            $categories = $this->repository->getListCategories($request->all());
            DB::commit();
            return response()->json([
                'categories' => $categories,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => ''
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function store(CategoryCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryService->create($request->all());
            DB::commit();
            return response()->json([
                'data' => ['id' => $category->id],
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.category.create.success')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->repository->find($id);
            DB::commit();
            return response()->json([
                'data' => $category,
                'error' => false,
                'code' => 'SUCCESS'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
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
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryService->update($request->all(), $id);
            DB::commit();
            return response()->json([
                'data' => ['category' => $category],
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.category.update.success')
            ], 200);
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->repository->delete($id);
            DB::commit();
            return response()->json([
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.category.delete.success')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
