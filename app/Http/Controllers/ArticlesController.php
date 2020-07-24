<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\EntityMediaRepository;
use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ArticlesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ArticlesController extends Controller
{
    /**
     * @var ArticleRepository
     */
    protected $repository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var MediaRepository
     */
    protected $mediaRepository;

    /**
     * @var EntityMediaRepository
     */
    protected $entityMediaRepository;

    /**
     * ArticlesController constructor.
     *
     * @param ArticleRepository $repository
     * @param CategoryRepository $categoryRepository
     * @param MediaRepository $mediaRepository
     * @param EntityMediaRepository $entityMediaRepository
     */
    public function __construct(
        ArticleRepository $repository,
        CategoryRepository $categoryRepository,
        MediaRepository $mediaRepository,
        EntityMediaRepository $entityMediaRepository
    )
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->mediaRepository = $mediaRepository;
        $this->entityMediaRepository = $entityMediaRepository;
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
            $articles = $this->repository->getListArticles($request->all());
            DB::commit();
            return response()->json([
                'data' => $articles,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => ''
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
     * Store a newly created resource in storage.
     *
     * @param ArticleCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ArticleCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $article = $this->repository->createArticle($request->all());
            DB::commit();
            return response()->json([
                'data' => $article,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.article.create.success')
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
            $article = $this->repository->with('medias')->find($id);
            DB::commit();
            return response()->json([
                'data' => $article,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => ''
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->repository->find($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $article = $this->repository->updateArticle($request->all(), $id);
            DB::commit();
            return response()->json([
                'data' => $article,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.article.update.success')
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
            $this->entityMediaRepository->deleteWhere(['entity_id' => $id]);
            DB::commit();
            return response()->json([
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.article.delete.success')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        return view('articles.create');
    }
}
