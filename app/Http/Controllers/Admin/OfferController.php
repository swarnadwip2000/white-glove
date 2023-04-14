<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderby('id', 'desc')->get();
        return view('admin.offers.list')->with(compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
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
            'offer' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $offer = new Offer();
        $offer->offer = $request->offer;
        $offer->title = $request->title;
        
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $image_path = $request->file('image')->store('offers', 'public');
            $offer->image = $image_path;
        }

        $offer->save();

        return redirect()->route('offers.index')
                        ->with('message','Offer created successfully.');
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
        $offer = Offer::find($id);
        return view('admin.offers.edit')->with(compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {      
        //
    }


    public function offerUpdate(Request $request)
    {
        $request->validate([
            'offer' => 'required',
            'title' => 'required',
        ]);
         
        $offer = Offer::find($request->id);
        $offer->offer = $request->offer;
        $offer->title = $request->title;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $image_path = $request->file('image')->store('offers', 'public');
            $offer->image = $image_path;
        }
        $offer->save();

        return redirect()->route('offers.index')
                        ->with('message','Offer updated successfully');
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

    public function delete($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        return redirect()->route('offers.index')
                        ->with('message','Offer deleted successfully');
    }

    public function changeOfferStatus(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        $offer->status = $request->status;
        $offer->save();
        return response()->json(['message'=>'Status change successfully.']);
    }
}
