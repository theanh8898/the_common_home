<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MediaCreateRequest;
use App\Http\Requests\MediaUpdateRequest;
use App\Repositories\MediaRepository;

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
     * MediaController constructor.
     *
     * @param MediaRepository $repository
     */
    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
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
     * @param  MediaCreateRequest $request
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
                'message'=>trans('messages.media.create.success')
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
     * @param  int $id
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
     * @param  int $id
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
     * @param  MediaUpdateRequest $request
     * @param  string            $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
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
                'message'=>trans('messages.media.create.success')
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Media deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Media deleted.');
    }
}
