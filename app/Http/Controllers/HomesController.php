<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\HomeCreateRequest;
use App\Http\Requests\HomeUpdateRequest;
use App\Repositories\HomeRepository;

/**
 * Class HomesController.
 *
 * @package namespace App\Http\Controllers;
 */
class HomesController extends Controller
{
    /**
     * @var HomeRepository
     */
    protected $repository;


    /**
     * HomesController constructor.
     *
     * @param HomeRepository $repository
     */
    public function __construct(HomeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $homes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $homes,
            ]);
        }

        return view('homes.index', compact('homes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HomeCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(HomeCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $home = $this->repository->createHome($request->all());
            DB::commit();
            return response()->json([
                'data' => $home,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.home.create.success')
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
        $home = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $home,
            ]);
        }

        return view('homes.show', compact('home'));
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
        $home = $this->repository->find($id);

        return view('homes.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HomeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(HomeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $home = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Home updated.',
                'data'    => $home->toArray(),
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
                'message' => 'Home deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Home deleted.');
    }
}
