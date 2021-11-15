<?php

namespace App\Http\Controllers\API;

use App\Models\Ad;
use App\Enums\Paginate;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Ad::when($request->filled('category_id'), function($query) use($request) {
            return $query->where('category_id', $request->category_id);
        })
        ->when($request->has('tag_ids') && count($request->tag_ids) > 0, function($query) use($request) {
            return $query->whereHas('tags', function($query) use($request) {
                return $query->whereIn('tag_id', $request->tag_ids);
            });
        })
        ->paginate(Paginate::PER_PAGE);
        return responsePaginate(AdResource::collection($result));
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ad $ad)
    {
        return responseSuccessData(new AdResource($ad));
    }   
}