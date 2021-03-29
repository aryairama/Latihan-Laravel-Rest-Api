<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;
use \App\Http\Resources\BookCollection;
use \App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->only(['create','store','show','edit','update','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::paginate(8);
        return new BookCollection($data);
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
        //
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

    public function top($count)
    {
        $data = Book::orderBy('views', 'DESC')->limit($count)->get();
        return new BookCollection($data);
    }

    public function slug($slug)
    {
        $data = Book::where('slug', $slug)->first();
        $data->views = $data->views +1;
        $data->save();
        // return $data->categories();
        return new BookResource($data);
    }

    public function search($keyword)
    {
        $data = Book::where('title', 'LIKE', "%$keyword%")->orderBy('views', 'DESC')->get();
        return new BookCollection($data);
    }
}
