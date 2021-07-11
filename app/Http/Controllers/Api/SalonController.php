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

class SalonController extends Controller
{
    public function  category(){
        $categories= Categories:: Selection()->get();
        return response()->json($categories);
    }



    public function  getSalonByID(Request  $request){



        $user = Salon::find(1);

        return $user->toJson();

        return $user->toJson(JSON_PRETTY_PRINT);
   //   $salon = Salon::Selection()->where('id', $request->id)->with('salonImages')->with('salonServices')->with('salonOffers')->get();
//      //  $salon = Salon::Selection()->where('id', $request->id)->with('salonImages')->with('salonServices')->with('salonOffers')->get();
//        if (!$salon)
//            return $this->returnError('001', 'هذا القسم غير موجد');

//        return response()->json($salon);


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
        $evaluation  = SavedItems::select(
            "users.name  as user_name",
            "salons.salon_name",
            "salons.salon_description",
            "salons.salon_address"


        )->join("users", "saved_items.user_id", "=", "users.id")->join("salons", "saved_items.user_id", "=", "salons.id")->where('salon_id', $request->salon_id)->where('saved_items.user_id',Auth::user()->id)->get();

        return response()->json($evaluation);
    }





}
