<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdCreateRequest;
use App\Http\Resources\Api\AdResource;
use App\Http\Resources\Api\AdShowResource;
use Illuminate\Http\Request, Illuminate\Http\JsonResponse;

class AdController extends Controller
{

    protected const PAGINATE = 10;

    public function index(): JsonResponse
    {

        $ads = AdResource::collection(Ad::paginate(self::PAGINATE));

        if ($ads->count()) {
            return response()->json([
                'status' => 'success',
                'ads' => $ads,
                'last_page' => $ads->lastPage(),
                'current_page' => $ads->currentPage(),
            ]);
        }

        return response()->json(['status' => 'error', 'message' => __('ad.response.error.empty_ad_list')]);
    }

    public function store(AdCreateRequest $request)
    {

        $validate = $request->validated();
        $images = $validate['images'];
        unset($validate['images']);
        $ad = Ad::create($validate);
        $ad->adImages()->createMany($images);

        if($ad->save()) {
            return response()->json(['status' => 'success', 'message' => $ad->id]);
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
