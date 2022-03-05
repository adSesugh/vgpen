<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Contribution;

/**
 * Class ContributionTransformer.
 *
 * @package namespace App\Transformers;
 */
class ContributionTransformer extends TransformerAbstract
{
    /**
     * Transform the Contribution entity.
     *
     * @param \App\Entities\Contribution $model
     *
     * @return array
     */
    public function transform(Contribution $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
