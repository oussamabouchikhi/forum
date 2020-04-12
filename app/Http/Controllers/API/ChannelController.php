<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ChannelResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Channel;
use Validator;

class ChannelController extends Controller
{
    /**
     * Display a listing of the Channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // method1
        // return response()->json([
        //     'error' => false,
        //     'channels' => Channel::all()
        // ], 200);
        // method2
        return ChannelResource::collection(Channel::all());
    }

    /**
     * Store a newly created Channel in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make validation
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:channels'
        ]);

        // If validation fails
        if ( $v->fails() ) {

            return response()->json([
                'error' => true,
                'errors' => $v->errors()
            ], 422);
        }

        // Create channel
        $channel = new Channel([
            'title' => $request->title
        ]);
        $channel->save();

        return new ChannelResource($channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
        return new ChannelResource($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        // Make validation
        $v = Validator::make($request->all(), [
            'title' => 'required|unique:channels'
        ]);

        // If validation fails
        if ( $v->fails() ) {

            return response()->json([
                'error' => true,
                'errors' => $v->errors()
            ], 422);
        }

        // Update & save channel title
        $channel->title = $resuest->title;
        $channel->save();

        return new ChannelResource($channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        // Delete channel
        $channel->delete();

        // return response()->json(null, 204); #method 1
        return response()->json([
            'error'   => false,
            'message' => 'The channel $channel->title was successfully deleted'
        ], 200);
    }
}
