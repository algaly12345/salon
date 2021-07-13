<?php

namespace App\Http\Controllers;


use App\Http\Requests\storeUserRequest;
use App\Http\Requests\VerificationRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\VerificationServices;
use App\Models\Evaluation;
use App\Models\SavedItems;
use App\Providers\RouteServiceProvider;
use App\Traits\GeneralTrait;
use App\User;
use App\Views;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use GeneralTrait;
    /*
       |--------------------------------------------------------------------------
       | Register Controller
       |--------------------------------------------------------------------------
       |
       | This controller handles the registration of new users as well as their
       | validation and creation. By default this controller uses a trait to
       | provide this functionality without requiring any additional code.
       |
       */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public $sms_services;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VerificationServices $sms_services)
    {
        $this->middleware('guest');
        $this -> sms_services = $sms_services;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function register(Request $data)
    {
        try {
            $rules = [
                'name' => 'required',
                'email'    => 'unique:users|required',
                'password' => 'required',

            ];

            $input     = $data->only('name', 'email','password');
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return response()->json(['success' => 'exist']);
            }

          //  DB::beginTransaction();
            $verification = [];
            $user = User::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'imageUrl'=>'ImageUrl',
                'password'=>Hash::make($data['password']),
            ]);

            return response()->json(['success' => 'success']);
            //return new UserResource($user);

            // send OTP SMS code
            // set/ generate new code
//            $verification['user_id'] = $user->id;
//            $verification_data =  $this->sms_services->setVerificationCode($verification);
//            $message = $this->sms_services->getSMSVerifyMessageByAppName($verification_data -> code );
            //save this code in verifcation table
            //done
            //send code to user mobile by sms gateway   // note  there are no gateway credentails in config file
            # app(VictoryLinkSms::class) -> sendSms($user -> mobile,$message);
            DB::commit();
            return  $user;
            //send to user  mobile
        }catch(\Exception $ex){
            return $ex;
           // DB::rollback();
        }

    }


    public function current(Request  $request)  {

        $request['id']= $this->id;
        $request['name']= $this->name;
        $request['email']= $this->email;
        return $request;
    }


    public function verify(VerificationRequest $request)
    {
        $check = $this ->  verificationService -> checkOTPCode($request -> code);
        if(!$check){  // code not correct
            //  return 'you enter wrong code ';
            return redirect() -> route('get.verification.form')-> withErrors(['code' => 'ألكود الذي ادخلته غير صحيح ']);
        }else {  // verifiction code correct
            $this ->  verificationService -> removeOTPCode($request -> code);
            return redirect()->route('home');
        }
    }


    public function rate(Request $request)
    {
        $order = new Evaluation();
        $order->user_id = auth()->guard('api')->user()->id;
        $order->salon_id = $request->salon_id;
        $order->rating = $request->rating;
        $order->content =$request->contents;

        $order->save();
        return response()->json(['success' => 'success']);

    }


    public function views(Request $request)
    {
        $order = new Views();
        $order->user_id = auth()->guard('api')->user()->id;
        $order->salon_id = $request->salon_id;


        $order->save();
        return response()->json(['success' => 'success']);

    }


    public function saveItem(Request $request)
    {
        $item = new SavedItems();
        $item->user_id = auth()->guard('api')->user()->id;
        $item->salon_id = $request->salon_id;
        $item->save();
        return response()->json(['success' => 'success']);

    }
}

