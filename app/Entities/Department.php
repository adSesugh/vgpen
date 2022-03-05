<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use App\Models\User;

class Department extends Model implements Transformable
{
    use TransformableTrait;

    protected $connection = 'sqlsrv';

    protected $fillable = ['department_name', 'department_head'];

    protected $dates = ['created_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function username($id)
    {
        $username = User::where('department_id', $id)->pluck('name')->first();

        return $username;
    }

}
