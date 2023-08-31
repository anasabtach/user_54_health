<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\DealRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{   

    public function __construct(){
        $this->__viewData['header_class'] = '';
        $this->__viewData['body_class'] = '';
        $this->__viewData['is_show_footer'] = true;
        $this->__viewData['footer_class'] = 'mt';
    }

    public function index(){//show all the promotions
        $this->__viewData['footer_class'] = 'mt';
        $this->__viewData['promotions'] = Deal::withCount(['ratings'=>function($query){
            $query->whereNull('parent_id');
        }])->get();

        return $this->__renderView('promotions.index');
    }

    public function promotionDetails($id){//show the promotion details page
        $this->__viewData['promotion'] = Deal::withCount(['ratings'=>function($query){
            $query->whereNull('parent_id');
        }])->findOrFail(base64_decode($id));

        return $this->__renderView('promotions.detail');
    }

    public function rating(Request $req){//update the rating of promitions
        
        $rules = [
            'rating'        => ['required'],
            'promotion_id'  => ['required'],
            'description'   => ['required', 'string', 'max:65000']
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($req->all());
        
        DealRating::updateOrCreate([//if
            'user_id'   => auth()->id(),
            'deal_id'   => base64_decode($req->promotion_id),
        ],[
            'rating'    => $req->rating,
            'comment'   => $req->description
        ]);
        return redirect()->back()->with('success', 'Reivew added successfully');
        
    }

    public function reply(Request $req){
        $rules = [
            'reply'     => ['required', 'max:65000'],
            'parent_id' => ['required'],
            'deal_id'   => ['required']
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->with('error', 'some error occured pleae try again');
        }

        DealRating::create([
            'parent_id'=>base64_decode($req->parent_id), 
            'user_id'=> auth()->id(), 
            'deal_id'=>base64_decode($req->deal_id),
            'rating' => 0.0,
            'comment'=> $req->reply
        ]);

        return redirect()->back()->with('success', 'replied successfully');
    }
}
