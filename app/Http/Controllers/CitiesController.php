<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CityCreateRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Repositories\CityRepository;

/**
 * Class CitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CitiesController extends Controller
{
    /**
     * @var CityRepository
     */
    protected $repository;


    /**
     * CitiesController constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
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
        $cities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cities,
            ]);
        }

        return view('cities.index', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CityCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CityCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $city = $this->repository->createCity($request->all());
            DB::commit();
            return response()->json([
                'data' => $city,
                'error' => false,
                'code' => 'SUCCESS',
                'message' => trans('messages.city.create.success')
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
        $city = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $city,
            ]);
        }

        return view('cities.show', compact('city'));
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
        $city = $this->repository->find($id);

        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $city = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'City updated.',
                'data'    => $city->toArray(),
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
                'message' => 'City deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'City deleted.');
    }
}
