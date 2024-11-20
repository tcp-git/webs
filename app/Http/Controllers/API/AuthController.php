<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $username     = $request->username;
            $password  = $request->password;
            // dd(Auth::attempt(['username' => $username, 'password' => $password]));
            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                $user = Auth::User();
                //  dd($user->role->permissions->pluck('name','description'));
                // $permission = ['Read-User'];
                 $permission = $user->role->permissions->pluck('name')->toArray();
                //  dd(json_encode($permission));
                $accessToken = $user->createToken($username, $permission)->accessToken;
                // dd($accessToken);
                $token = $user->createToken('Token Name')->accessToken;

                $data = [];
                $data['data'] = $user;
                $data['token'] = $accessToken;
                $data['permission'] = $user->role->permissions->pluck('name');
                return $this->returnDataResponse($data);
            }else{
                $data = [];
                $data['response_code'] = '400';
                return response(['message' => 'Unauthorized'],403);
            }
        } catch (\Exception $e) {
            Log::info($e);
            return $e;
        }
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->picture = $request->picture;
        $user->role_id = $request->role_id;
        $user->organization_id = $request->organization_id;
        $user->active = $request->active;
        $user->password = Hash::make($request->password);

        if(!$user->save()){
            return $this->returnErrorResponse(404,'Login Fail','LOGIN_FAIL');
        }
        return $this->returnDataResponse($user);
    }
}
