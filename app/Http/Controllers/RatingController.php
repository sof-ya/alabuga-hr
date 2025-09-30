<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use App\Services\RatingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct(private RatingService $ratingService) {

    }

    public function getUsersRating(): BaseResponse
    {
        $ratingData = $this->ratingService->getUsersRating(
            auth()->user()->role_id,
            auth()->user()->rank_id,
        );

        return new BaseResponse($ratingData, JsonResponse::HTTP_OK);
    }

    public function getMyRatingPosition() : BaseResponse {
        $ratingData = $this->ratingService->getUserPosition(
            auth()->user(),
            auth()->user()->role_id,
            auth()->user()->rank_id,
        );

        return new BaseResponse($ratingData, JsonResponse::HTTP_OK);
    }
}
