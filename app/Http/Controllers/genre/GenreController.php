<?php

namespace App\Http\Controllers\genre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genre = Genre::all();
        return $genre;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::all();
        return $genre;
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
            'name'             =>'required|max:191',
        ]);


        $genre = new Genre;
        $genre->name = $request->name;
        $genre->save();
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
        $genre = Movie::find($id);
        if($genre) {
            return response()->json(['Movies' => $genre], 200);
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
        $genre = Movie::find($id);
        if($genre) {
            return response()->json(['Movies' => $genre], 200);
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
        $genre = Genre::find($id);
        $genre->name = $request->name;
        $genre->update();
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
        $genre = Genre::find($id);
        if($genre)
        {
            $genre->delete($id);
            return response()->json(['message'=>'Record Deleted Successfully']);
        }
        else
        {
            return response()->json(['message'=>'Record Not found']);
        }
    }
}
