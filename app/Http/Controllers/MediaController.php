<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaCreateRequest;
use App\Http\Requests\MediaUpdateRequest;
use App\Repositories\EntityMediaRepository;
use App\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class MediaController.
 *
 * @package namespace App\Http\Controllers;
 */
class MediaController extends Controller
{
    /**
     * @var MediaRepository
     */
    protected $repository;

    /**
     * @var EntityMediaRepository
     */
    protected $entityMediaRepository;

    /**
     * MediaController constructor.
     *
     * @param MediaRepository $repository
     * @param EntityMediaRepository $entityMediaRepository
     */
    public function __construct(MediaRepository $repository, EntityMediaRepository $entityMediaRepository)
    {
        $this->repository = $repository;
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
            $medias = $this->repository->getListMedia($request->all());
            DB::commit();
            return response()->json([
                'data' => $medias,
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
     * @param MediaCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MediaCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $media = $this->repository->createMedia($request->all());
            DB::commit();
            return response()->json([
                'data' => $media,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.media.create.success')
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medium = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $medium,
            ]);
        }

        return view('media.show', compact('medium'));
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
        $medium = $this->repository->find($id);

        return view('media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MediaUpdateRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function update(MediaUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $media = $this->repository->updateMedia($request->all(), $id);
            DB::commit();
            return response()->json([
                'data' => $media,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.media.update.success')
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
            $entityMedias = $this->entityMediaRepository->findWhere(['media_id' => $id])->count();
            if ($entityMedias > 0) {
                return response()->json([
                    'error' => true,
                    'message' => trans('messages.media.delete.fail')
                ], 500);
            } else {
                $this->repository->delete($id);
            }
            DB::commit();
            return response()->json([
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.media.delete.success')
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
