<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->get_listing_summaries();
        $data = $this->add_meta_data($data);
        return view('app', compact('data'));
    }

    public function index_api() {
        $data = $this->get_listing_summaries();
        $data = $this->add_meta_data($data);
        return response()->json($data);
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
     * @param  Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        $data = $this->get_listing($listing);
        $data = $this->add_meta_data($data);
        return view('app', compact('data'));
    }

    public function show_api(Listing $listing) {
        $data = $this->get_listing($listing);
        $data = $this->add_meta_data($data);
        return response()->json($data);
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

    protected function get_listing(Listing $listing) {
        $model = $listing->toArray();
        for($i = 1; $i <=4; $i++) {
            $model['image_' . $i] = asset('images/' . $listing->id . '/Image_' . $i . '.jpg');
        }
        return collect(['listing' => $model]);
    }

    protected function get_listing_summaries() {
        $collection = Listing::all([
            'id', 'address', 'title', 'price_per_night'
        ]);
        $collection->transform(function($listing) {
            $listing->thumb = asset('images/' . $listing->id . '/Image_1_thumb.jpg');
            return $listing;
        });
        return collect(['listings' => $collection->toArray()]);
    }

    protected function add_meta_data($collection) {
        return $collection->merge([
            'path' => request()->getPathInfo(),
            'auth' => auth()->check(),
            'saved' => auth()->check() ? auth()->user()->saved : []
        ]);
    }
}
