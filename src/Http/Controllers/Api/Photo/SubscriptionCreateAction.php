<?php

namespace Facilitador\Http\Actions;

use App\Http\Requests\ReCaptchaRequest;
use App\Http\Resources\SubscriptionPlainResource;
use App\Models\Contracts\SubscriptionManager;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

/**
 * Class SubscriptionCreateAction.
 *
 * @package App\Http\Actions
 */
class SubscriptionCreateAction
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var SubscriptionManager
     */
    private $subscriptionManager;

    /**
     * SubscriptionCreateAction constructor.
     *
     * @param ResponseFactory     $responseFactory
     * @param SubscriptionManager $subscriptionManager
     */
    public function __construct(ResponseFactory $responseFactory, SubscriptionManager $subscriptionManager)
    {
        $this->responseFactory = $responseFactory;
        $this->subscriptionManager = $subscriptionManager;
    }

    /**
     * @apiVersion        1.0.0
     * @api               {post} /v1/subscriptions Create
     * @apiName           Create
     * @apiGroup          Subscriptions
     * @apiHeader         {String} Accept application/json
     * @apiHeader         {String} Content-Type application/json
     * @apiParamExample   {json} Request-Body-Example:
     * {
     *     "email": "username@domain.name"
     * }
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 201 Created
     * {
     *     "email": "username@mail.address",
     *     "token": "subscription_token_string"
     * }
     */

    /**
     * Create a subscription.
     *
     * @param  ReCaptchaRequest $request
     * @return JsonResponse
     */
    public function __invoke(ReCaptchaRequest $request): JsonResponse
    {
        $subscription = $this->subscriptionManager->create($request->all());

        return $this->responseFactory->json(new SubscriptionPlainResource($subscription), JsonResponse::HTTP_CREATED);
    }
}
