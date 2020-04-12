<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\DiscussionResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discussion;
use Validator;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the Discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all discussions
        return DiscussionResource::collecrion(Discussion::all());
    }

    /**
     * Store a newly created Discussion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make validation
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:discussions',
            'content' => 'required'
        ]);

        // If validation fails
        if ( $v->fails() ) {

            return response()->json([
                'error' => true,
                'errors' => $v->errors()
            ], 422);
        }


        $discussion = new Discussion([
            'title'      => $request->title,
            'content'    => $request->content,
            'slug'       => $request->slug,
            'user_id'    => $request->user_id,
            'channel_id' => $request->channel_id
        ]);
        $discussion->save();

        return new DiscussionResource($discussion);

    }

    /**
     * Display the specified Discussion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return new DiscussionResource($discussion);
    }

    /**
     * Update the specified Discussion in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        // Make validation
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:discussions',
            'content' => 'required'
        ]);

        // If validation fails
        if ( $v->fails() ) {

            return response()->json([
                'error' => true,
                'errors' => $v->errors()
            ], 422);
        }

        $discussion->title         = $request->title;
        $discussion->content       = $request->content;
        $discussion->channel_id    = $request->channel_id;
        $discussion->slug          = $request->slug;

        $discussion->save();

        return new DiscussionResource($discussion);
    }

    /**
     * Remove the specified Discussion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return response()->json(null, 204);
    }
}
