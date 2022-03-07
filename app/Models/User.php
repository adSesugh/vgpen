<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Entities\Department;
use App\Entities\Team;
use App\Entities\Region;
use App\Entities\Employee;

use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'sqlsrv';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'mktusers';

    protected $fillable = [
        'name', 'email', 'staffId', 'phone_number','department_id', 'team_id', 'region_id', 'password',
        'photo', 'leadership_worthy', 'status' ,'pinTarget', 'newBusiness', 'financialTargetExisting',
        'financialTargetNewBusiness'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function leadership()
    {
        return User::where('leadership_worthy', true)->pluck('name', 'id')->all();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'agent_code', 'staffId');
    }

    public function deptName()
    {
        $dept_name = null;
        if(auth()->user()->hasRole('hod')){
            $dept_name = Department::whereId(auth()->user()->department_id)->pluck('department_name')->first();
        }

        return $dept_name;
    }

    public function regName()
    {
        $reg_name = null;
        if (auth()->user()->hasRole('region-head')) {
            $reg_name = Region::whereId(auth()->user()->region_id)->pluck('region_name')->first();
        }

        return $reg_name;
    }

    public function teamName()
    {
        $team_name = null;
        if (auth()->user()->hasRole('team-leader')) {
            $team_name = Team::whereId(auth()->user()->team_id)->pluck('team_name')->first();
        }

        return $team_name;
    }
}
