<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdCreateRequest;
use App\Http\Resources\Api\AdResource;
use App\Http\Resources\Api\AdShowResource;
use Illuminate\Http\JsonResponse;

class AdController extends Controller
{

    protected const PAGINATE = 10;

    public function index(): JsonResponse
    {

        $sort = request()->sort;

        if (!is_null($sort)) {
            $sort = json_decode($sort);
        }

        $orderCreatedAt = $sort && $sort->created_at ? 'ASC' : 'DESC';
        $orderPrice = $sort && $sort->price ? 'ASC' : 'DESC';

        $ads = Ad::orderByRaw("price $orderPrice, created_at $orderCreatedAt");

        $adsCollection = AdResource::collection($ads->paginate(self::PAGINATE));

        if ($adsCollection->count()) {
            return response()->json([
                'status' => 'success',
                'ads' => $adsCollection,
                'last_page' => $adsCollection->lastPage(),
                'current_page' => $adsCollection->currentPage(),
            ]);
        }

        return response()->json(['status' => 'error', 'message' => __('ad.response.error.empty_ad_list')]);
    }

    public function store(AdCreateRequest $request): JsonResponse
    {

        $validate = $request->validated();
        $validate['price'] = floatval($validate['price']);
        $images = $validate['images'];
        unset($validate['images']);
        $ad = Ad::create($validate);
        $ad->adImages()->createMany($images);

        if($ad->save()) {
            return response()->json(['status' => 'success', 'ad' => $ad->id]);
        }

        return response()->json(['status' => 'error', 'message' => 'Not save data ad!']);
    }


    public function show($id): JsonResponse
    {

        $ad = AdShowResource::collection(Ad::whereId($id)->get());

        if ($ad->count()) {
            return response()->json(['status' => 'success', 'ad' => $ad]);
        }

        return response()->json(['status' => 'error', 'message' => __('ad.response.error.not_found_ad')]);
    }

}
