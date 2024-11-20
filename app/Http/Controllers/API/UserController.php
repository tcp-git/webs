<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all()->toQuery();
        // foreach($users as $value)
        // {
        //     $value->roles->name;
        //     $value->roles->makeHidden('created_at');
        //     $value->roles->makeHidden('updated_at');
        // }
        // $user = $users->toQuery();
        // $user = User::with('roles')

        // return $user;
        foreach($user as $value)
        {
            $value->roles->name;

        }
        if (!$user) {
            return $this->returnErrorResponse(404, 'User Not Found', 'USER_NOT_FOUND');
        }

        $orderByColumn = (request()->has('sort_by')) ? request()->input('sort_by') : 'random';
        $orderByDirection = (request()->has('order_by')) ? request()->input('order_by') : 'ASC';
        if ($orderByColumn === 'random') {
            $user->inRandomOrder();
        } else {
            $user->orderBy($orderByColumn, $orderByDirection);
        }


        // Paging
        $per_page = (request()->has('per_page') ? request()->input('per_page') : 10);
        $offset = (request()->has('offset') ? request()->input('offset') : 0);
        $page = floor($offset / $per_page) + 1;
        $users = $user->with('roles')->paginate($per_page, ['*'], null, $page);
        return $this->returnDataWithPageResponse($users,['sort_by' => $orderByColumn,'order_by' => $orderByDirection]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new User;
        $user->username = $request->username;
        $user->organization_id = $request->organization_id;
        $user->picture = $request->picture;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->active = $request->active;

        return $user->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->returnErrorResponse(404, 'User Not Found', 'USER_NOT_FOUND');
        }

        return $this->returnDataResponse($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->organization_id = $request->organization_id;
        $user->picture = $request->picture;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->active = $request->active;

        if (!$user->save()) {
            return $this->returnErrorResponse(404, 'User Not Update', 'USER_NOT_UPDATE');
        }

        return $this->returnDataResponse($user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user->delete()) {
            return $this->returnErrorResponse(404, 'User Not Delete', 'USER_NOT_DELETE');
        }

        return $this->returnDataResponse($user);
    }
}
