<?php

namespace App\Http\Controllers\APITOKEN;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $member = new Member;
        $member->room_id = $request->room_id;
        $member->reference1 = $request->reference1;
        $member->reference2 = $request->reference2;
        $member->reference3 = $request->reference3;
        $member->doctor = $request->doctor;
        $member->moderator = $request->moderator;
        $member->mic = $request->mic;
        $member->vdo = $request->vdo;
        $member->shared = $request->shared;
        $member->created_user_id = $request->created_user_id;
        $member->updated_user_id = $request->updated_user_id;

        if (!$member->save()) {
            return $this->returnErrorResponse(404, 'Member Not Insert', 'MEMBER_NOT_INSERT');
        }

        return $this->returnDataResponse($member);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return $this->returnErrorResponse(404, 'Member Not Found', 'MEMBER_NOT_FOUND');
        }

        return $this->returnDataResponse($member);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $member = Member::where("id", $id)->update([
        //     "name" => $request->name,
        //     "start_at" => $request->start_at,
        //     "end_at" => $request->end_at,
        //     "updated_user_id" => $request->updated_user_id
        // ]);
        // return $member;
        $member = Member::find($id);
        $member->reference1 = $request->reference1;
        $member->reference2 = $request->reference2;
        $member->reference3 = $request->reference3;
        $member->doctor = $request->doctor;
        $member->moderator = $request->moderator;
        $member->mic = $request->mic;
        $member->vdo = $request->vdo;
        $member->shared = $request->shared;
        $member->updated_user_id = $request->updated_user_id;
        if (!$member->save()) {
            return $this->returnErrorResponse(404, 'Member Not Update', 'MEMBER_NOT_UPDATE');
        }

        return $this->returnDataResponse($member);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);
        if (!$member->delete()) {
            return $this->returnErrorResponse(404, 'Member Not Delete', 'MEMBER_NOT_DELETE');
        }

        return $this->returnDataResponse($member);
    }
}
