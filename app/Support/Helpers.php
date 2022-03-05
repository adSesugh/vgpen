<?php

use Mpdf\Mpdf;
use App\User;
use Carbon\Carbon;
use Mpdf\Output\Destination;

if (!function_exists('settings')) {

    function settings()
    {
        return new App\Support\Settings;
    }
}

if (!function_exists('socCount')) {

    function socCount()
    {
        return DB::connection('sqlsrv')->table('marketers_payment_nosoc')->select(DB::raw('(distinct idno)'))
            ->where('agent_code', auth()->user()->staffId)->count();
    }
}

if (!function_exists('mpsPin')) {

    function mpsPin()
    {
        return DB::table('marketer_contribution_mps')->where('agent_code', auth()->user()->staffId)->count();
    }
}

if (!function_exists('mpsAum')) {

    function mpsAum()
    {
        return DB::table('marketer_contribution_mps_aum')->where('agent_code', auth()->user()->staffId)->count();
    }
}

if (!function_exists('uploadedFile')) {

    function uploadedFile($id)
    {
        return DB::connection('sqlsrv')->table('soc_submitted_log')->where('idno', $id)
            ->where('agent_code', auth()->user()->staffId)->exists();
    }
}

if(!function_exists('pinExTarget'))
{
    function pinEXTarget($code)
    {
        $days = Carbon::today()->dayOfYear;
        $count = user::where('staffId', $code)->pluck('pinTarget')->first();

        $pins = ceil($days/365 * $count);

        return $pins;
    }
}

if(!function_exists('pinExAcheived'))
{
    function pinExAcheived($code)
    {
        $days = Carbon::today()->dayOfYear;
        $count = DB::table('marketer_contribution_existing')->where('agent_code', $code)->count();

        $pins = $count;

        return $pins;
    }
}

if(!function_exists('pinTarget'))
{
    function pinTarget($code)
    {
        $days = Carbon::today()->dayOfYear;
        $count = user::where('staffId', $code)->pluck('newBusiness')->first();

        $pins = ceil($days/365 * $count);

        return $pins;
    }
}

if(!function_exists('pinAcheived'))
{
    function pinAcheived($code)
    {
        $days = Carbon::today()->dayOfYear;
        $count = DB::table('marketer_contribution_new')->where('agent_code', $code)->count();

        $pins = $count;

        return $pins;
    }
}

if(!function_exists('aumExTarget'))
{
    function aumExTarget($code)
    {
        $days = Carbon::today()->dayOfYear;
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));
        $t_aum_new = user::where('staffId', $code)->pluck('financialTargetExisting')->first();

        $total_aum_new = ceil($days/365 * $t_aum_new);

        return $total_aum_new;
    }
}

if(!function_exists('aumExAcheived'))
{
    function aumExAcheived($code)
    {
        $days = Carbon::today()->dayOfYear;
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));

        $t_aum_new = DB::table('marketers_contribution')->whereAgentCode($code)
        ->whereDate('value_date', '>=', $current_year)->whereDate('upload_date', '<', $current_year)->sum('total_contribution');

        $total_aum_new = $t_aum_new;

        return $total_aum_new;
    }
}

if(!function_exists('aumTarget'))
{
    function aumTarget($code)
    {
        $days = Carbon::today()->dayOfYear;
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));
        $t_aum_new = user::where('staffId', $code)->pluck('financialTargetNewBusiness')->first();

        $total_aum_new = ceil($days/365 * $t_aum_new);

        return $total_aum_new;
    }
}

if(!function_exists('aumAcheived'))
{
    function aumAcheived($code)
    {
        $days = Carbon::today()->dayOfYear;
        $current_year = date('Y-m-d', strtotime(settings()->get('operating_year')));

        $t_aum_new = DB::table('marketers_contribution')->whereAgentCode($code)
        ->whereDate('value_date','>=', $current_year)->whereDate('upload_date', '>=', $current_year)->sum('total_contribution');

        $total_aum_new = $t_aum_new;

        return $total_aum_new;
    }
}

if (!function_exists('mpsPin')) {
    function mpsPin($code)
    {
        $mps_pin = DB::table('marketer_contribution_mps')
            ->select(DB::raw('count(distinct PIN) as pins'))->where('agent_code', auth()->user()->id)->get();

        return $mps_pin;
    }
}


if (!function_exists('mpsAum')) {
    function mpsAum($code)
    {
        $mps_aum = DB::table('marketer_contribution_mps_aum')
            ->select(DB::raw('sum(total_contribution) as amount'))->where('agent_code', auth()->user()->id)->get();

        return $mps_aum;
    }
}

if (!function_exists('api')) {

    function api($response, $code = 200)
    {
        return response()
            ->json($response, $code);
    }
}

if (!function_exists('uploadFile')) {

    function uploadFile($file, $dir = 'storage/app/uploads/')
    {
        $fileName = str_random(32) . '.' . $file->extension();

        if ($file->move(base_path($dir), $fileName)) {
            return $fileName;
        }

        return null;
    }
}

if (!function_exists('deleteFile')) {

    function deleteFile($fileName, $dir = 'storage/app/uploads/')
    {
        return File::delete(base_path($dir) . $fileName);
    }
}

if (!function_exists('pdf')) {

    function pdf($file, $model)
    {

        $pdf = pdfRaw($file, $model);


        $file = $model->number . '-' . time() . '.pdf';

        if (request()->has('mode') && request()->mode == 'download') {
            return $pdf->Output($file, Destination::DOWNLOAD);
        }

        return $pdf->Output($file, Destination::INLINE);
    }
}

function pdfRaw($file, $model)
{
    $options = settings()->getMany(['header-html', 'footer-html']);
    $options = array_filter($options, function ($key) {
        return !is_null($key);
    });

    // dd($options['header-html']);
    $html = view($file, ['model' => $model, 'options' => $options]);
    $pdf = new Mpdf(config('pdf'));
    $pdf->WriteHTML($html);

    return $pdf;
}
