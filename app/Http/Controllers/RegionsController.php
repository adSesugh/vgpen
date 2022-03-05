<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RegionCreateRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Repositories\RegionRepository;
use App\Validators\RegionValidator;

use App\Models\User;

/**
 * Class RegionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class RegionsController extends Controller
{
    /**
     * @var RegionRepository
     */
    protected $repository;

    /**
     * @var RegionValidator
     */
    protected $validator;

    /**
     * RegionsController constructor.
     *
     * @param RegionRepository $repository
     * @param RegionValidator $validator
     */
    public function __construct(RegionRepository $repository, RegionValidator $validator)
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
        $regions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $regions,
            ]);
        }

        $leaders = User::leadership();

        $flag = true;

        return view('regions.index', compact('regions', 'flag', 'leaders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RegionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RegionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $region = $this->repository->create($request->all());

            $response = [
                'message' => 'Region created.',
                'data'    => $region->toArray(),
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
        $region = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $region,
            ]);
        }

        return view('regions.show', compact('region'));
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
        $region = $this->repository->find($id);

        $regions = $this->repository->all();

        $flag = false;

        $leaders = User::leadership();

        return view('regions.index', compact('region','flag', 'leaders','regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RegionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RegionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $region = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Region updated.',
                'data'    => $region->toArray(),
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
                'message' => 'Region deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Region deleted.');
    }
}
