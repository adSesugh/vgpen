<?php

namespace App\Presenters;

use App\Transformers\ContributionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContributionPresenter.
 *
 * @package namespace App\Presenters;
 */
class ContributionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContributionTransformer();
    }
}
