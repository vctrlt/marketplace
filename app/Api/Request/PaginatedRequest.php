<?php

namespace App\Api\Request;


use App\Api\Response\Response;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * TODO documentation
 */
abstract class PaginatedRequest extends Request
{
    /**
     * Default value for `per_page` parameter. If `null`, the `per_page` parameter is always required.
     * @var int|null
     */
    protected $perPageDefault = 10;

    /**
     * @inheritDoc
     */
    protected function _rules(Validator $validator = null)
    {
        return [
            'per_page' => ($this->perPageDefault === null ? 'required|' : '') . 'integer',
            'page' => 'integer',
            ] + parent::_rules($validator);
    }


    /**
     * @inheritDoc
     */
    protected function doResolve($name, Collection $parameters)
    {
        $perPage = $parameters->get('per_page', $this->perPageDefault);
        $page = $parameters->get('page', 1);

        $urlParameters = $this->_urlParameters($parameters);
        $query = [
            'per_page' => $perPage
        ];

        foreach($urlParameters as $parameter) {
            if ($parameters->has($parameter)) {
                $query[$parameter] = $parameters[$parameter];
            }
        }

        /** @var Paginator $paginator */
        $paginator = $this->paginator($parameters, $perPage, $page);
        $paginator->appends($query);
        $paginator->setPath(route('api.single', ['name' => $name], false));

        $resource = $this->resourceClass();
        $result = null;

        if ($resource) {
            if (is_subclass_of($resource, ResourceCollection::class)) {
                $resource = new $resource($paginator);
            } else {
                $resource = new AnonymousResourceCollection($paginator, $resource);
            }

            /** @var ResourceCollection $resource */
            $array = $paginator->toArray();
            $array['data'] = $resource->toArray(null);
            $result = $array;
        } else {
            $result = $paginator->toArray();
        }

        //ensure that data will be encoded as an array
        $result['data'] = array_values($result['data']);

        return new Response(true, $result);
    }

    /**
     * Returns an array of parameters that should be present in the URL get query in next/previous URLs
     * @param Collection $parameters
     * @return string[]
     */
    protected abstract function urlParameters(Collection $parameters);

    /**
     * Returns an array of parameters that should be present in the URL get query in next/previous URLs.
     * Should be used by abstract classes and should always concatenate result with parent implementation.
     * @param Collection $parameters
     * @return string[]
     */
    protected function _urlParameters(Collection $parameters)
    {
        return $this->urlParameters($parameters);
    }

    /**
     * Returns a Paginator instance to be used
     * @param Collection $parameters
     * @param integer $perPage
     * @param integer $page
     * @return Paginator
     */
    protected abstract function paginator(Collection $parameters, $perPage, $page);

    /**
     * Returns name of a Resource class to be used. If false, no Resource class used
     * @return string|false
     */
    protected function resourceClass()
    {
        return false;
    }
}