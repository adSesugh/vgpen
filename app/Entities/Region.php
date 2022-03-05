<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use App\Models\User;

class Region extends Model implements Transformable
{
    use TransformableTrait;

    protected $connection = 'sqlsrv';

    protected $fillable = ['region_name', 'region_head'];

    protected $dates = ['created_at'];

    public function users()
    {
        return $this->HasMany(User::class, 'region_id');
    }

    public function username($id)
    {
        $username = User::where('region_id', $id)->pluck('name')->first();

        return $username;
    }

}
