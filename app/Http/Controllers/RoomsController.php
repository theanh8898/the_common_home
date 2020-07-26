<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Repositories\RoomRepository;
use App\Validators\RoomValidator;

/**
 * Class RoomsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RoomsController extends Controller
{
    /**
     * @var RoomRepository
     */
    protected $repository;

    /**
     * @var RoomValidator
     */
    protected $validator;

    /**
     * RoomsController constructor.
     *
     * @param RoomRepository $repository
     * @param RoomValidator $validator
     */
    public function __construct(RoomRepository $repository, RoomValidator $validator)
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
        $rooms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rooms,
            ]);
        }

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RoomCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $room = $this->repository->createRoom($request->all());
            DB::commit();
            return response()->json([
                'data' => $room,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.room.create.success')
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
        $room = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $room,
            ]);
        }

        return view('rooms.show', compact('room'));
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
        $room = $this->repository->find($id);

        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoomUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $room = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Room updated.',
                'data'    => $room->toArray(),
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
                'message' => 'Room deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Room deleted.');
    }
}
