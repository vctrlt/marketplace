<?php

namespace App\Http\Controllers;


use App\Api\ByeRequest;
use App\Api\HelloRequest;
use App\Api\Request\Request as ApiRequest;
use App\Api\Response\CompositeResponse;
use App\Api\Response\Response as ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller for the internal API that is used exclusively by the frontend.
 */
class InternApiController extends Controller
{
    private $requests;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->requests = [
            'hello' => HelloRequest::class,
            'bye' => ByeRequest::class
        ];
    }

    public function index(Request $request)
    {
        $data = json_decode($request->input("api"));

        $responses = [];
        if ($data != null) {
            foreach ($data as $requestName => $parameters) {

                if (isset($this->requests[$requestName])) {
                    $class = $this->requests[$requestName];

                    /** @var ApiRequest $request */
                    $request = new $class();

                    if ($parameters instanceof \stdClass) {
                        $parameters = (array)$parameters;
                    } elseif ($parameters !== (array)$parameters) {
                        $parameters = [];
                    }

                    $responses[] = $request->resolve($requestName, $parameters);
                } else {
                    $responses[] = new ApiResponse($requestName, false, "Unknown request.");
                }
            }
        }

        $compositeResponse = new CompositeResponse($responses);

        return new JsonResponse($compositeResponse->getAsJson(), 200, [], true);
    }
}