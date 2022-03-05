<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\Employee;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $days = Carbon::today()->dayOfYear;
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));
        $previous_year = Carbon::today()->subYear(1);

        $conn = DB::connection('sqlsrv');

        if(auth()->user()->hasRole('admin'))
        {
            return view('dashboard');
        }

        if($conn) {

            $total_aum_new = $conn->table('marketers_contribution')->whereAgentCode(auth()->user()->staffId)
                ->whereDate('value_date','>=', $current_year)->whereDate('upload_date', '>=', $current_year)->sum('total_contribution');
            dd($total_aum_new);
            $total_aum_existing = $conn->table('marketers_contribution')->whereAgentCode(auth()->user()->staffId)
                ->whereDate('value_date', '>=', $current_year)->whereDate('upload_date', '<', $current_year)->sum('total_contribution');

            $user_targets = User::whereId(auth()->user()->id)->select('pinTarget', 'newBusiness', 'financialTargetExisting', 'financialTargetNewBusiness')->first();

            $user_pin_new = Employee::whereAgentCode(auth()->user()->staffId)->whereDate('upload_date', '>=', $current_year)->count('PIN');
            $user_pin_normal = Employee::whereAgentCode(auth()->user()->staffId)->whereDate('upload_date', '<', $current_year)->count('PIN');

            $normal_pins_target = ceil($days/365 * $user_targets->pinTarget);
            $normal_pins_achieved = ceil($days/365 * $user_pin_normal);
            $variance_pin = $normal_pins_target - $normal_pins_achieved;

            $new_business_pins = ceil($days/365 * $user_targets->newBusiness);
            $new_business_record = ceil($days / 365 * $user_pin_new);
            $variance_biz = $new_business_pins - $new_business_record;

            $financial_existing = ceil($days/365 * $total_aum_existing);
            $financial_existing_target = ceil($days/365 * $user_targets->financialTargetExisting);

            $financial_new_buiness = ceil($days / 365 * $total_aum_new);
            $financial_new_target = ceil($days / 365 * $user_targets->financialTargetNewBusiness);

            $variance_aum_ex = $financial_existing_target - $financial_existing;
            $variance_new_aum = $financial_new_target - $financial_new_buiness;

            $nortargets = [];
            $normal_target = Arr::prepend($nortargets, $normal_pins_target);
            $normal_target = json_encode(Arr::prepend($normal_target, $normal_pins_achieved));
            //$normal_target = json_encode(array_prepend($normal_target, $variance_pin));

            $newBiz = [];
            $newBusinessPin = Arr::prepend($newBiz, $new_business_record);
            $newBusinessPin = json_encode(Arr::prepend($newBusinessPin, $new_business_pins));
            //$newBusinessPin = json_encode(array_prepend($newBusinessPin, $variance_biz));

            $fin_existing = [];
            $finExisting = Arr::prepend($fin_existing, $financial_existing_target);
            $finExisting = json_encode(Arr::prepend($finExisting, $financial_existing));
            //$finExisting = json_encode(array_prepend($finExisting, $variance_aum_ex));

            $fin_new = [];
            $finNewBiz = Arr::prepend($fin_new, $financial_new_buiness);
            $finNewBiz = json_encode(Arr::prepend($finNewBiz, $financial_new_target));
            //$finNewBiz = json_encode(array_prepend($finNewBiz, $variance_new_aum));

            $top_aums = DB::connection('sqlsrv')->table( 'marketers_contribution')->whereAgentCode(auth()->user()->staffId)
                ->whereDate('value_date','>=', $current_year)->whereDate('upload_date', '>', $current_year)->limit(10)->get();

            return view('dashboard', compact('top_aums','variance_new_aum','variance_aum_ex', 'variance_biz','variance_pin','financial_new_buiness', 'financial_new_target','financial_existing_target', 'financial_existing','normal_pins_target', 'normal_pins_achieved', 'new_business_record', 'new_business_pins','normal_target', 'newBusinessPin', 'finExisting', 'finNewBiz'));
        }
    }

    public function getUser($id) {
        $user = User::whereuuid($id)->first();

        return view('auth.profile', compact('user'));
    }
}
