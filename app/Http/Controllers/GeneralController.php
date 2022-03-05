<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Entities\Team;
use App\Entities\Department;
use App\Entities\Region;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Image;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function team_m()
    {
        $team_members = [];
        $team_leader = Team::whereId(auth()->user()->team_id)->pluck('id')->first();

        if(auth()->user()->hasRole('team-leader')) {

            $team_members = User::where('team_id', $team_leader)->get();
        }
        elseif(auth()->user()->hasRole('admin')){
            $team_members = User::where('team_id', $team_leader)->get();
        }

        return view('generals.team_m', compact('team_members'));
    }

    public function dept_m()
    {
        $dept_members = [];

        $dept_leader = Department::whereId(auth()->user()->department_id)->pluck('id')->first();

        if (auth()->user()->hasRole('hod')) {
            $dept_members = User::where('department_id', $dept_leader)->where('name', '<>', 'Super Admin')->get();
        }
        elseif(auth()->user()->hasRole('admin'))
        {
            $dept_members = User::where('department_id', $dept_leader)->get();
        }

        return view('generals.dept_m', compact('dept_members'));
    }

    public function region_m()
    {
        $region_members = [];
        $region_leader = Region::whereId(auth()->user()->id)->pluck('id')->first();

        if (auth()->user()->hasRole('regional-head')) {
            $region_members = User::where('region_id', $region_leader)->get();
        }
        elseif(auth()->user()->hasRole('admin'))
        {
            $region_members = User::where('region_id', $region_leader)->get();
        }

        return view('generals.region_m', compact('region_members'));
    }

    public function user_rec()
    {
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));
        $pin_rec = DB::connection('sqlsrv')->table('marketer_pin_reconciliation')->get();

        return view('generals.pin_rec', compact('pin_rec'));
    }

    public function user_create()
    {
        $id = request()->get('agent_code');
        $roles = Role::where('name', '<>', 'admin')->pluck('display_name', 'id')->all();
        $regions = Region::pluck('region_name', 'id')->all();
        $teams = Team::pluck('team_name', 'id')->all();
        $departments = Department::pluck('department_name', 'id')->all();

        return view('generals.pfa_create', compact('roles', 'regions', 'teams', 'departments'));
    }

    public function user_store(Request $request)
    {
        $imagePath = '/uploads/';

        $input = $request->all();

        $image = $request->photo;

        if (!empty($image) && $image->isValid()) {
            $extension = $image->getClientOriginalExtension(); // getting image extension
            $fileName = Str::of($input['name'])->slug('-') . '.' . $extension; // renameing image
            Image::make($image->getRealPath())->resize(150, 150)->save(public_path() . $imagePath . $fileName);

            $input['photo'] = $imagePath . $fileName;
        } else {
            array_except($input, ['photo']);
        }

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $user->attachRole($request->input('role'));

        return redirect()->route('users.index');
    }

    public function newPin()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $pins = DB::connection('sqlsrv')->table('marketer_contribution_new')->where('agent_code', '')->get();

        return view('generals.newpin', compact('pins'));
    }

    public function existPin()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $pins = DB::connection('sqlsrv')->table('marketer_contribution_existing')->where('agent_code', auth()->user()->staffId)->get();

        return view('generals.expin', compact('pins'));
    }

    public function newAum()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $aums = DB::connection('sqlsrv')->table('marketers_contribution')->select('value_date', 'employer_name', 'employer_rcno', DB::raw('sum(total_contribution) as contribution'), 'contribution_date')
            ->whereAgentCode(auth()->user()->staffId)->whereDate('upload_date', '>=', $current_year)
            ->groupBy('value_date', 'employer_name', 'employer_rcno', 'contribution_date')
            ->orderBy('value_date','desc')
            ->get();

        return view('generals.naum', compact('aums'));
    }

    public function existAum()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $aums = DB::connection('sqlsrv')->table('marketers_contribution')->select('value_date', 'employer_name', 'employer_rcno', DB::raw('sum(total_contribution) as contribution'), 'contribution_date')
            ->whereAgentCode(auth()->user()->staffId)->whereDate('upload_date', '<', $current_year)->whereDate('upload_date', '!<', Carbon::today()->subYear(2))
            ->groupBy('value_date', 'employer_name', 'employer_rcno', 'contribution_date')
            ->orderBy('value_date','desc')
            ->get();

        return view('generals.eaum', compact('aums'));
    }

    public function searchPin(Request $request)
    {
        $pin = $request->get('employee_pin');
        abort_if(!$pin, 404);
        $employee = DB::connection('sqlsrv')->table('customer_biodata')->where('PIN', '=', $pin)->first();

        return view('generals.issue_pin', compact('employee'));
    }

    public function pdf($pin)
    {
        abort_if(!$pin, 404);
        $data = DB::connection('sqlsrv')->table('customer_biodata')->where('PIN', '=', $pin)->first();

        $filename = $data->SURNAME.'-'.$data->FIRSTNAME.'-'.$data->OTHERNAMES.'- Letter.pdf';

        $pdf = PDF::loadView('docs.print_welcome', ['data' => $data]);

        return $pdf->download($filename);
    }

    public function soc()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $socs = DB::connection('sqlsrv')->table('marketers_payment_nosoc')->select('idno', 'employer_code', 'value_date', 'amount', 'amount_processed', 'description', 'employer_name')
            ->where('agent_code', '=', auth()->user()->staffId)->orderBy('value_date', 'desc')->whereDate('value_date','>', $current_year)->get();
        //dd($socs);
        return view('generals.soc', compact('socs'));
    }

    public function withoutSoc()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $flag =false;
        $pwsoc = true;

        $socs = DB::connection('sqlsrv')->table('marketers_payment_nosoc')->select('idno', 'employer_code', 'value_date', 'amount', 'amount_processed', 'description', 'employer_name')
            ->where('agent_code', '=', auth()->user()->staffId)->orderBy('value_date', 'desc')->whereDate('value_date','>', $current_year)->get();
        //dd($socs);
        return view('generals.soc', compact('socs', 'flag', 'pwsoc'));
    }

    public function withResidue()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);
        $flag = true;
        $pwsoc = false;

        $socs = DB::connection('sqlsrv')->table('marketers_payment_residue')->select('idno', 'employer_code', 'value_date', 'amount', 'amount_processed', 'residue', 'description', 'employer_name')
            ->where('agent_code', '=', auth()->user()->staffId)->orderBy('value_date', 'desc')->whereDate('value_date','>', $current_year)->get();
        //dd($socs);
        return view('generals.soc', compact('socs', 'flag', 'pwsoc'));
    }

    public function uploadSoc($id)
    {

        $socs = DB::connection('sqlsrv')->table('marketers_payment_nosoc')->select('idno', 'value_date','description', 'employer_name')
            ->where('agent_code', '=', auth()->user()->staffId)->orderBy('value_date', 'desc')->where('idno', $id)->first();

        return view('generals.upload', compact('socs'));
    }

    public function submitSoc(Request $request)
    {
        $filePath = '/uploads/files/';

        $this->validate($request, [
            'upload_file' => ['required', 'mimes:doc,docx,pdf,xls,xlsx,jpeg,png']
        ]);

        $file = $request->file('upload_file');
        $file_name = null;

        if (!empty($file) && $file->isValid()) {
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $fileName = $request->idno. '.' . $extension; // renameing image
            //Image::make($file->getRealPath())->resize(150, 150)->save(public_path() . $filePath . $fileName);
            $file->move(public_path().$filePath, $fileName);
            $file_name = $filePath . $fileName;
        }

        $send = DB::connection('sqlsrv')->table('soc_submitted_log')->insert([
            'IDNO' => $request->idno,
            'DESCRIPTION'   => $request->description,
            'AGENT_CODE'    =>  auth()->user()->staffId,
            'FILE_PATH'  => $file_name,
            'DATE_STAMP'  => now(),
            'AMOUNT'    => $request->amount,
        ]);

        if($send) {
            return redirect()->route('without.soc');
        }

        return redirect()->back();
    }

    public function mpsPin()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $mps_pins = DB::connection('sqlsrv')->table('marketer_contribution_mps')->where('agent_code', auth()->user()->agent_code)->get();

        return view('generals.mps_pin', compact('mps_pins'));
    }

    public function mpsAum()
    {
        $cy = strtotime(settings()->get('operating_year'));
        $current_year = date('Y-m-d', $cy);

        $mps_aums = DB::connection('sqlsrv')->table('marketer_contribution_mps_aum')->where('agent_code', 'PS0213')->get();

        return view('generals.mps_aum', compact('mps_aums'));
    }
}
