<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EntityMediaCreateRequest;
use App\Http\Requests\EntityMediaUpdateRequest;
use App\Repositories\EntityMediaRepository;
use App\Validators\EntityMediaValidator;

/**
 * Class EntityMediaController.
 *
 * @package namespace App\Http\Controllers;
 */
class EntityMediaController extends Controller
{
    /**
     * @var EntityMediaRepository
     */
    protected $repository;

    /**
     * @var EntityMediaValidator
     */
    protected $validator;

    /**
     * EntityMediaController constructor.
     *
     * @param EntityMediaRepository $repository
     * @param EntityMediaValidator $validator
     */
    public function __construct(EntityMediaRepository $repository, EntityMediaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $entityMedia = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $entityMedia,
            ]);
        }

        return view('entityMedia.index', compact('entityMedia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EntityMediaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EntityMediaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $entityMedia = $this->repository->create($request->all());

            $response = [
                'message' => 'EntityMedia created.',
                'data'    => $entityMedia->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $entityMedia = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $entityMedia,
            ]);
        }

        return view('entityMedia.show', compact('entityMedia'));
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
        $entityMedia = $this->repository->find($id);

        return view('entityMedia.edit', compact('entityMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EntityMediaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EntityMediaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $entityMedia = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EntityMedia updated.',
                'data'    => $entityMedia->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
                'message' => 'EntityMedia deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EntityMedia deleted.');
    }
}
