<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Meta;
use DB;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'new_size' => 'required',
            'new_count' => 'required'
        ]);

        $meta = Meta::where('video_id', $id)->get();
        $meta->video_size = $request->input('new_size');
        $meta->viewrs_count = $request->input('new_count');
        $meta->save();

        $data = [
            'success' => 'video details updated'
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function videoSize($user)
    {
        $data = DB::select("select sum(m.video_size) total_video_size from videos v, metas m where v.video_id = m.video_id and v.created_by = '$user'");
        
        if($data[0]->total_video_size == null)
        {
            $error = [ 'error' => 'No Video Found'];
            return response()->json($error);
        }
        return response()->json($data);
    }

    public function videoMetadata($id)
    {
        $data = DB::select("select m.video_size video_size, m.viewrs_count viewrs, v.created_by created_by from videos v, metas m where v.video_id = m.video_id and v.video_id = '$id'");
        
        if($data == null)
        {
            $error = [ 'error' => 'No Video Found'];
            return response()->json($error);
        }
        return response()->json($data);
    }
}
