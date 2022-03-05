<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use App\Models\User;

class Team extends Model implements Transformable
{
    use TransformableTrait;
    protected $connection = 'sqlsrv';

    protected $fillable = ['team_name', 'team_leader'];

    protected $dates = ['created_at'];

    public function users()
    {
        return $this->HasMany(User::class, 'team_id');
    }

    public function username($id)
    {
        $username = User::where('team_id', $id)->pluck('name')->first();

        return $username;
    }
}
