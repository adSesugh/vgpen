<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContributionRepository;
use App\Entities\Contribution;
use App\Validators\ContributionValidator;

/**
 * Class ContributionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContributionRepositoryEloquent extends BaseRepository implements ContributionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contribution::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ContributionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
