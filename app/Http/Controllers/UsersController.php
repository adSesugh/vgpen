<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Entities\Region;
use App\Entities\Team;
use App\Entities\Department;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use Image;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '<>', 'admin')->pluck('name', 'id')->all();
        $regions = Region::pluck('region_name', 'id')->all();
        $teams = Team::pluck('team_name', 'id')->all();
        $departments = Department::pluck('department_name', 'id')->all();

        return view('users.create', compact('roles', 'regions', 'teams', 'departments'));
    }

    public function store(UserCreateRequest $request)
    {
        $imagePath = '/uploads/';

        $input = $request->all();

        $image = $request->photo;

        if (!empty($image) && $image->isValid()) {
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = str_slug($input['name'], $separator = "-") . '.' . $extension; // renameing image
            Image::make($image->getRealPath())->resize(150, 150)->save(public_path() . $imagePath . $fileName);

            $input['photo'] = $imagePath . $fileName;
        } else {
            array_except($input, ['photo']);
        }

        $input['password'] = Hash::make($input['password']);
        if($input['pinTarget'] == null){
            $input['pinTarget'] = 0;
        }

        if($input['newBusiness'] == null){
            $input['newBusiness'] = 0;
        }

        if($input['financialTargetExisting'] == null){
            $input['financialTargetExisting'] = 0;
        }
        if($input['financialTargetNewBusiness'] == null){
            $input['financialTargetNewBusiness'] = 0;
        }

        $input['slug'] = Str::of($input['name'])->slug('-');

        $user = User::create($input);

        $user->assignRole($request->input('role'));

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::whereId($id)->first();
        $team_members = User::whereTeamId(auth()->user()->team_id)->get();
        $new_biz = DB::connection('sqlsrv')->table('marketer_contribution_new')->where('agent_code', auth()->user()->staffId)->count();
        $ex_biz = DB::connection('sqlsrv')->table('marketer_contribution_existing')->where('agent_code', auth()->user()->staffId)->count();
        //$new_aum = DB::connection('sqlsrv')->table('marketers_contribution')->where('agent_code', auth()->user()->staffId)->get();

        return view('users.show', compact('user', 'team_members', 'new_biz','ex_biz'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '<>', 'admin')->pluck('name', 'id')->all();
        $regions = Region::pluck('region_name', 'id')->all();
        $teams = Team::pluck('team_name', 'id')->all();
        $departments = Department::pluck('department_name', 'id')->all();

        return view('users.edit', compact('user', 'roles', 'regions', 'teams', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $imagePath = '/uploads/';

        $input = $request->all();
        $user = User::findOrFail($id);

        $image = $request->photo;

        if (!empty($image) && $image->isValid()) {
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = str_slug($input['name'], $separator = "-") . '.' . $extension; // renameing image
            Image::make($image->getRealPath())->resize(150, 150)->save(public_path() . $imagePath . $fileName);

            $input['photo'] = $imagePath . $fileName;
        } else {
            array_except($input, ['photo']);
        }

        $inputx = null;

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
            $user->update($input);
        } else {
            $inputx = array_except($input, ['password']);
            $user->update($inputx);
        }

        $roleCheck = DB::table('model_has_roles')->whereModelId($id)->first();

        if($roleCheck && !empty(request()->get('role'))) {
            DB::table('model_has_roles')->where('model_id', $id)->update([
                'role_id'   => request()->get('role'),
            ]);
        }
        else {
            $user->assignRole($request->input('role'));
        }

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        abort(404);
    }

    public function changepasscode($slug)
    {
        $user = User::whereSlug($slug)->first();

        return view('auth.changepassword',compact('user'));
    }

    public function storepasscode(Request $request, $slug)
    {
        abort_if($id=null, 404);

        $user = User::whereSlug($slug)->whereEmail(auth()->user()->email)->first();
        $input = $request->all();
        $this->validate($request, [
            'current_password' => 'required',
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
            $user->save();

            if($user) {

                Auth::logout();

                session()->flush();

                session()->regenerate();

                return redirect()->route('home');
            }
        }
        else {
            return redirect()->back()->withInputError();
        }
    }
}
