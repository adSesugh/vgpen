<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Repositories\TeamRepository;
use App\Validators\TeamValidator;
use App\Models\User;

/**
 * Class TeamsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TeamsController extends Controller
{
    /**
     * @var TeamRepository
     */
    protected $repository;

    /**
     * @var TeamValidator
     */
    protected $validator;

    /**
     * TeamsController constructor.
     *
     * @param TeamRepository $repository
     * @param TeamValidator $validator
     */
    public function __construct(TeamRepository $repository, TeamValidator $validator)
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
        $teams = $this->repository->all();

        $leaders = User::leadership();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teams,
            ]);
        }

        $flag = true;

        // create the number to words "manager" class
        //dd(Team::numberToWords(5120));

        return view('teams.index', compact('teams','leaders','flag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TeamCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TeamCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $team = $this->repository->create($request->all());

            $response = [
                'message' => 'Team created.',
                'data'    => $team->toArray(),
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
        $team = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $team,
            ]);
        }

        return view('teams.show', compact('team'));
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
        $team = $this->repository->find($id);
        $teams = $this->repository->all();

        $leaders = User::leadership();

        $flag = false;

        return view('teams.index', compact('team', 'teams', 'leaders', 'flag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TeamUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TeamUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $team = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Team updated.',
                'data'    => $team->toArray(),
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
                'message' => 'Team deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Team deleted.');
    }
}
