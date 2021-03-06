<?php

namespace App\Api\Request\DB\Chat;


use App\Api\Request\Request;
use App\Api\Response\Response;
use App\Events\MessageSent;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;

/**
 * API request to send a message.
 *
 * @package App\Api\Request\DB\Chat
 */
class MessageSendRequest extends Request
{
    /** @var Guard */
    protected $guard;

    /**
     * MessageSendRequest constructor.
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
     * @inheritdoc
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
            'to' => 'required|string|min:1|max:2000',
            'content' => 'required_if:additional,null|sometimes|string',
            'additional' => 'required_if:content,null|sometimes|array',
            'identifier' => 'sometimes|string',
        ];
    }

    /**
     * @inheritDoc
     *
     * @param string     $name
     * @param Collection $parameters
     *
     * @return Response
     */
    protected function doResolve($name, Collection $parameters)
    {
        /** @var User $user */
        $user = $this->guard->user();

        $message = new Message([
            'from_username' => $user->username,
            'to_username' => $parameters['to'],
            'content' => $parameters['content'],
            'additional' => $parameters->get('additional', null),
            'identifier' => $parameters->get('identifier', null),
        ]);

        $first = (Message::orderByDesc('created_at')
                ->whereDate('created_at', '>=', Carbon::today())
                ->where([
                    'from_username' => $user->username,
                    'to_username' => $parameters['to'],
                ])
                ->count()) === 0;

        $message->save();

        broadcast(new MessageSent($message, $first))->toOthers();

        return new Response(true, \App\Http\Resources\Message::make($message));
    }

}