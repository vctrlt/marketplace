<?php

namespace App\Api\Request\DB\Offer;


use App\Api\Request\DB\SearchRequest;
use App\Offer;

class OfferSearchRequest extends SearchRequest
{
    protected $modelClass = Offer::class;
    protected $resourceClass = \App\Http\Resources\Offer::class;

    /**
     * @inheritDoc
     * @param Offer $model
     */
    function filterResult($model)
    {
        return $model->displayable;
    }
}