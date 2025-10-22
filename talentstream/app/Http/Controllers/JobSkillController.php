<?php

namespace App\Http\Controllers;

use App\Models\JobSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobSkillController extends Controller
{
         public function index()
     
    {
        $js = JobSkill::all();
        return view('pages.job-skill.job-skills',compact('js'));
    }

    
       public function create()
    {
        return view('pages.create-js');
    }

    public function store(Request $request)
    {

        JobSkill::create($request->only([
            'name',
            'amount',
            'price',
        ]));
        // dd($request->all());


        return Redirect::to('/JobSkill');
    }

    
    public function destroy(Request $request)
    {
        $product = JobSkill::find($request->js_id);
        $product->delete();
        return Redirect::to('/JobSkill');
}

 public function update($js_id)
    {
        $js = JobSkill::find($js_id);
        return view('pages.job-skill.edit-js',compact('js'));
    }

       public function editStore(Request $request)
    {
       $js = JobSkill::find($request->js_id);
        $js->name = $request->name;
        $js->amount = $request->amount;
        $js->price = $request->price;
        $js->save();
        return Redirect::to('/job-skill');
    }
}