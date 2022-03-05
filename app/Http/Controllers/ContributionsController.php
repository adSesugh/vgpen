<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContributionCreateRequest;
use App\Http\Requests\ContributionUpdateRequest;
use App\Repositories\ContributionRepository;
use App\Validators\ContributionValidator;

/**
 * Class ContributionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ContributionsController extends Controller
{
    /**
     * @var ContributionRepository
     */
    protected $repository;

    /**
     * @var ContributionValidator
     */
    protected $validator;

    /**
     * ContributionsController constructor.
     *
     * @param ContributionRepository $repository
     * @param ContributionValidator $validator
     */
    public function __construct(ContributionRepository $repository, ContributionValidator $validator)
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
        $contributions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contributions,
            ]);
        }

        return view('contributions.index', compact('contributions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContributionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ContributionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contribution = $this->repository->create($request->all());

            $response = [
                'message' => 'Contribution created.',
                'data'    => $contribution->toArray(),
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
        $contribution = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contribution,
            ]);
        }

        return view('contributions.show', compact('contribution'));
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
        $contribution = $this->repository->find($id);

        return view('contributions.edit', compact('contribution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContributionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ContributionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contribution = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Contribution updated.',
                'data'    => $contribution->toArray(),
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
                'message' => 'Contribution deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Contribution deleted.');
    }
}
