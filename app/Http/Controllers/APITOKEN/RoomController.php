<?php

namespace App\Http\Controllers\APITOKEN;

use Carbon\Carbon;
use App\Models\Room;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
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
        $room = new Room;
        $room->name = $request->name;
        $room->start_at = $request->start_at;
        $room->end_at = $request->end_at;
        $room->created_user_id = $request->created_user_id;
        $room->updated_user_id = $request->updated_user_id;
        $room->service_id = $request->service_id;
        // $room->save();
        if (!$room->save()) {
            return $this->returnErrorResponse(404, 'Room Not Insert', 'ROOM_NOT_INSERT');
        }

        return $this->returnDataResponse($room);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd(request()->Header('invitrace-api-key'));
        $room = Room::find($id);
        $data =  $room->services->where('key',request()->Header('invitrace-api-key'));

        if (!$data) {
            return $this->returnErrorResponse(404, 'Room Not Found', 'ROOM_NOT_FOUND');
        }
        $room->makeHidden(['services']);
        return $this->returnDataResponse($room);
    }

    function showMembers(string $id)
    {
        $rooms = Room::find($id);
        $datas =  $rooms->members;
        $datakey =  $rooms->services->where('key',request()->Header('invitrace-api-key'));

        foreach ($datas as $data) {
            $key = '!@Invitrace@!';
            $nbf = strtotime(Carbon::now());
            $exp = strtotime(Carbon::now()->addHour(+1));
            $payload =  [
                "context" => [
                    "user" => [
                        "avatar" => "https:/gravatar.com/avatar/abc123",
                        "name" => $data->name,
                        "email" => "jdoe@example.com"
                    ]
                ],
                "aud" => "my_mikung",
                "iss" => "mikung",
                "sub" => "jitsi-invitrace.hyggecode.com",
                "room" => $rooms->name,
                "moderator" => $data->moderator,
                "nbf" => strtotime($rooms->start_at),
                // "nbf" => strtotime($rooms->start_at),
                "exp" => strtotime($rooms->end_at)
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            $data->jwt = $jwt;
            $data->link = 'https://jitsi-invitrace.hyggecode.com/'.$rooms->name.'?jwt='.$jwt.'';
        }
        // return count($datakey);
        if (!count($datakey)) {
            return $this->returnErrorResponse(404, 'Room Not Permission', 'ROOM_NOT_PERMISSION');
        }

        if (!$rooms) {
            return $this->returnErrorResponse(404, 'Room Not Found', 'ROOM_NOT_FOUND');
        }
        // $rooms->makeHidden(['services']);
        return $this->returnDataResponse($datas);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::find($id);
        $room->name = $request->name;
        $room->start_at = $request->start_at;
        $room->end_at = $request->end_at;
        $room->updated_user_id = $request->updated_user_id;
        if (!$room->save()) {
            return $this->returnErrorResponse(404, 'Room Not Update', 'ROOM_NOT_UPDATE');
        }

        return $this->returnDataResponse($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        if (!$room->delete()) {
            return $this->returnErrorResponse(404, 'Room Not Delete', 'ROOM_NOT_DELETE');
        }

        return $this->returnDataResponse($room);
    }
}
