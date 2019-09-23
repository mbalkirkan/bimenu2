<?php
namespace Bimenu\Http\Controllers\API;
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
if(Auth::attempt(['sicil' => request('sicil'), 'password' => request('password')])){
$user = Auth::user();
$success['token'] =  $user->createToken('MyApp')-> accessToken;
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
public function register(Request $request)
{
    dd("asfasfasfa");
$validator = Validator::make($request->all(), [
    'email' => 'required|email',
    'name' => 'required|string',
    'surname' => 'required|string',
    'phone' => 'required|numeric',
    'country' => 'required|numeric',
    'authority'=>'required|numeric',
    'photo' => 'required|string',
    'password' => 'required|string',
    'c_password' => 'required|same:password',
]);
if ($validator->fails()) {
return response()->json(['error'=>$validator->errors()], 401);
}
$input = $request->all();
$input['password'] = bcrypt($input['password']);
$user = User::create($input);
$success['token'] =  $user->createToken('MyApp')-> accessToken;
$success['name'] =  $user->name;
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
}
