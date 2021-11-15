<?php

namespace App\Http\Controllers\API;

use App\Enums\Paginate;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Requests\StoreTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Tag::paginate(Paginate::PER_PAGE);
        return responsePaginate(TagResource::collection($result));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $Tag = new Tag;
        $Tag->fill($request->validated());
        $Tag->save();
        return responseSuccessMessage('Created', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTagRequest $request, Tag $Tag)
    {
        $Tag->fill($request->validated());
        $Tag->save();
        return responseSuccessMessage('Updated', 201);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tag $Tag)
    {
        return responseSuccessData(new TagResource($Tag));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $Tag)
    {
        $Tag->delete();
        return responseSuccessMessage('Deleted', 200);
    }
}