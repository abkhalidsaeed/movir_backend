<?php

namespace App\Http\Controllers\movie;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::all();
        return $movie;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = Movie::all();
        return $movie;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             =>'required|max:191',
            'genre'             =>'required|max:191',
            // 'image'             => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'numberinstock'     =>'required|numeric|min:0|max:100',
            'dailyrental'       =>'required|numeric|min:0|max:10'

        ]);


        $movie = new Movie;
        $movie->title = $request->title;
        $movie->genre = $request->genre;
        // if ($request->hasfile('image')) {
        //     $image = $request->file('image');
        //     $imagename = trim($request->name) . '.' . $image->extension();
        //     $destinationPath = public_path('images/' . $imagename);
        //     Image::make($image)->save($destinationPath);
        //     $image = $imagename;
        // }
        // $movie->image = $request->image;
        $movie->numberinstock = $request->numberinstock;
        $movie->dailyrental = $request->dailyrental;
        $movie->save();
        return response()->json(['message'=>'Record added Successfully'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        if($movie) {
            return response()->json(['Movies' => $movie], 200);
        }
        else
        {
            return response()->json(['message'=>'Record Not found'],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        if($movie) {
            return response()->json(['Movies' => $movie], 200);
        }
        else
        {
            return response()->json(['message'=>'Record Not found'],404);
        }
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
        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->genre = $request->genre;
        // if ($request->hasfile('image')) {
        //     $image = $request->file('image');
        //     $imagename = trim($request->name) . '.' . $image->extension();
        //     $destinationPath = public_path('images/' . $imagename);
        //     Image::make($image)->save($destinationPath);
        //     $image = $imagename;
        // }
        // $movie->image = $request->image;
        $movie->numberinstock = $request->numberinstock;
        $movie->dailyrental = $request->dailyrental;
        $movie->update();
        return response()->json(['message'=>'Record updated Successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if($movie)
        {
            $movie->delete($id);
            return response()->json(['message'=>'Record Deleted Successfully']);
        }
        else
        {
            return response()->json(['message'=>'Record Not found']);
        }
    }
}
