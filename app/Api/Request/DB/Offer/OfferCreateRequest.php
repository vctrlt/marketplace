<?php

namespace App\Api\Request\DB\Offer;


use App\Api\Request\Request;
use App\Api\Response\Response;
use App\Offer;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * API request to create an offer
 *
 * @package App\Api\Request\DB\Offer
 */
class OfferCreateRequest extends Request
{
    use ProcessImages;

    /** @var Guard */
    protected $guard;

    /**
     * OfferCreateRequest constructor.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @inheritDoc
     */
    protected function shouldResolve()
    {
        return $this->guard->check();
    }

    /**
     * @inheritDoc
     *
     * @param Validator|null $validator
     *
     * @return array
     */
    protected function rules(
        Collection $parameters,
        Validator $validator = null
    )
    {
        return [
                'imageOrder' => 'required|array',
                'imageOrder.*.new' => 'required|boolean',
                'imageOrder.*.id' => 'required|integer',
            ] + Offer::getValidationRules($validator);
    }

    /**
     * @inheritDoc
     */
    protected function jsonParameters()
    {
        return ['imageOrder'];
    }

    /**
     * @inheritDoc
     *
     * @param            $name
     * @param Collection $parameters
     *
     * @return Response
     * @throws \Exception
     */
    protected function doResolve($name, Collection $parameters)
    {
        $offer = new Offer([
            'name' => $parameters['name'],
            'description' => $parameters->get('description'),
            'price_value' => $parameters->get('price', 0),
            'currency' => $parameters->get('currency'),
            'status' => $parameters->get('status', Offer::STATUS_AVAILABLE),
            'author_user_id' => $this->guard->id(),
        ]);

        $offer->save();

        $this->processImages($offer, $parameters['imageOrder'],
            $parameters['images'], false);

        return new Response(true, ['id' => $offer->id]);
    }

}