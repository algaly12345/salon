<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalonResource;
use App\Models\Categories;
use App\Models\Evaluation;
use App\Models\Salon;
use App\Models\SavedItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class SalonController extends Controller
{
    public function  category(){
        $categories= Categories:: Selection()->get();
        return response()->json($categories);
    }


    public function  getSalonBayCategoryID(Request $request){
        $salon = Salon::Selection()->where('category_id', $request->id)->with('salonImages')->with('salonServices')->with('salonOffers')->get();
        if (!$salon)
            return $this->returnError('001', 'هذا القسم غير موجد');
        return response()->json($salon);
    }


    public function getEvaluation(Request  $request){
        $evaluation  = Evaluation::select(
            "users.Id",
            "users.name  as user_name",
            "evaluations.rating",
            "evaluations.content"

        )->join("users", "evaluations.user_id", "=", "users.id")->where('salon_id', $request->salon_id)->get();

        return response()->json($evaluation);
    }



    public function getSaveIten(Request  $request){
        $evaluation  = Salon::select(
            "salons.id",
            "salons.salon_name",
            "salons.salon_description",
            "salons.salon_address"



        )->join("saved_items", "salons.id", "=", "saved_items.salon_id")->where('salon_id', $request->salon_id)->where('saved_items.user_id',Auth::user()->id)->with('salonImages')->with('salonServices')->with('salonOffers')->get();

        return response()->json($evaluation);
    }




    public function getViewUser(Request  $request){
        $evaluation  = Salon::select(
            "salons.id",
            "salons.salon_name",
            "salons.salon_description",
            "salons.salon_address"



        )->join("views", "salons.id", "=", "views.salon_id")->where('salon_id', $request->salon_id)->where('views.user_id',Auth::user()->id)->with('salonImages')->with('salonServices')->with('salonOffers')->get();

        return response()->json($evaluation);
    }







}
