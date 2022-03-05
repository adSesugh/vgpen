<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contribution.
 *
 * @package namespace App\Entities;
 */
class Contribution extends Model implements Transformable
{
    use TransformableTrait;
    protected $connection = 'sqlsrv';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
