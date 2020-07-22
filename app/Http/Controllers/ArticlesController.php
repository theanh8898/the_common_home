<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\EntityMediaRepository;
use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->category_id !== null) {
            $articles = $this->repository->with('medias')->findWhere(['category_id' => $request->category_id]);
        } else {
            $articles = $this->repository->with('medias')->all();
        }

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $articles,
            ]);
        }

        return view('articles.list', compact('articles'));
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
        try {
            $request['created_at'] = time();
            $request['updated_at'] = time();
            $article = $this->repository->create($request->all());
            $files = $request->file('files');
            $medias = json_decode($request->get('medias'));
            $this->repository->createMedias($files,$medias, $article->id);
            return response()->json([
                'error' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->repository->with('medias')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $article,
            ]);
        }

        return view('articles.show', compact('article'));
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
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $article = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Article updated.',
                'data' => $article->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Article deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Article deleted.');
    }

    public function create()
    {
        return view('articles.create');
    }
}
