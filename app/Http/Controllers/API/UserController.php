<?php
namespace Bimenu\Http\Controllers\API;
use Bimenu\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Bimenu\Http\Controllers\Controller;
use Bimenu\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */




    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['details'] =  $user;
            Auth::loginUsingId(1);
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['details'] =  $user;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $flight = User::find($user->id);

        $flight->notification_token = $request->ntoken;

        $flight->save();
        return response()->json( $this-> successStatus);
    }
}
