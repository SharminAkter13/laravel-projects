<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InterviewController extends Controller
{
         public function index()
     
    {
        $int = Interview::all();
        return view('pages.interview.interviews',compact('int'));
    }

    
       public function create()
    {
        return view('pages.create-int');
    }

    public function store(Request $request)
    {

        Interview::create($request->only([
            'name',
            'amount',
            'price',
        ]));
        // dd($request->all());


        return Redirect::to('/Interview');
    }

    
    public function destroy(Request $request)
    {
        $product = Interview::find($request->interview_id);
        $product->delete();
        return Redirect::to('/Interview');
}

 public function update($interview_id)
    {
        $int = Interview::find($interview_id);
        return view('pages.interview.edit-int',compact('int'));
    }

    public function editStore(Request $request)
    {
       $int = Interview::find($request->interview_id);
        $int->name = $request->name;
        $int->amount = $request->amount;
        $int->price = $request->price;
        $int->save();
        return Redirect::to('/interview');
    }


}
