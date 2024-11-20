<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
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
        $conference = new Conference;
        $conference->member_id = $request->member_id;
        $conference->room_id = $request->room_id;
        $conference->reference1 = $request->reference1;
        $conference->reference2 = $request->reference2;
        $conference->reference3 = $request->reference3;
        $conference->doctor = $request->doctor;
        $conference->moderator = $request->moderator;
        $conference->mic = $request->mic;
        $conference->vdo = $request->vdo;
        $conference->shared = $request->shared;
        $conference->created_user_id = $request->created_user_id;
        $conference->updated_user_id = $request->updated_user_id;

        if(!$conference->save()){
            return $this->returnErrorResponse(404,'Conference Not Insert','CONFERENCE_NOT_INSERT');
        }
        return $this->returnDataResponse($conference);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $conference = Conference::find($id);
        if(!$conference){
            return $this->returnErrorResponse(404,'Conference Not Found','CONFERENCE_NOT_FOUND');
        }

        return $this->returnDataResponse($conference);
    }

    function showMember(string $id)
    {
        $conferences = Conference::find($id);
        $conferences->members;

        if(!$conferences){
            return $this->returnErrorResponse(404,'Conference Not Found','CONFERENCE_NOT_FOUND');
        }

        return $this->returnDataResponse($conferences);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $conference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $conference = Conference::where("id", $id)->update([
        //     "name" => $request->name,
        //     "start_at" => $request->start_at,
        //     "end_at" => $request->end_at,
        //     "updated_user_id" => $request->updated_user_id
        // ]);
        // return $conference;
        $conference = Conference::find($id);
        $conference->reference1 = $request->reference1;
        $conference->reference2 = $request->reference2;
        $conference->reference3 = $request->reference3;
        $conference->doctor = $request->doctor;
        $conference->moderator = $request->moderator;
        $conference->mic = $request->mic;
        $conference->vdo = $request->vdo;
        $conference->shared = $request->shared;
        $conference->updated_user_id = $request->updated_user_id;
        if(!$conference->save()){
            return $this->returnErrorResponse(404,'Conference Not Update','CONFERENCE_NOT_UPDATE');
        }
        return $this->returnDataResponse($conference);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conference = Conference::find($id);
        if(!$conference->delete()){
            return $this->returnErrorResponse(404,'Conference Not Delete','CONFERENCE_NOT_DELETE');
        }
        return $this->returnDataResponse($conference);
    }
}
