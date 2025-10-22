<?php

namespace App\Http\Controllers;

// use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
         public function index()
     
    {
        return view('login');
    }

    
//        public function create()
//     {
//         return view('pages.create');
//     }

//     public function store(Request $request)
//     {

//         Login::create($request->only([
//             'name',
//             'amount',
//             'price',
//         ]));
//         // dd($request->all());


//         return Redirect::to('/Login');
//     }

    
//     public function destroy(Request $request)
//     {
//         $product = Login::find($request->catagory_id);
//         $product->delete();
//         return Redirect::to('/Login');
// }

//  public function update($catagory_id)
//     {
//         $log = Login::find($catagory_id);
//         return view('pages.login.edit-login',compact('log'));
//     }


}
