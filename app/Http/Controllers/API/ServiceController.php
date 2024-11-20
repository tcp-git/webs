<?php

namespace App\Http\Controllers\API;


use Carbon\Carbon;
use Firebase\JWT\JWT;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ServiceController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return $this->returnErrorResponse(404, 'Service Not Found', 'SERVICE_NOT_FOUND');
        }

        return $this->returnDataResponse($service);
    }


    /**
     * Display the specified resource.
     */
    public function showRoom(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->returnErrorResponse(404, 'Service Not Found', 'SERVICE_NOT_FOUND');
        }

        return $this->returnDataResponse($service);
    }


    public function getKey(string $key)
    {

        $service = Service::where('key', $key)->first();
        // return $service;
        $rooms =  $service->room;
        foreach ($rooms as $room) {
            $datas =  $room->members;
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
                    "room" => $room->name,
                    "moderator" => $data->moderator,
                    "nbf" => strtotime($room->start_at),
                    // "nbf" => strtotime($rooms->start_at),
                    "exp" => strtotime($room->end_at)
                ];
                $jwt = JWT::encode($payload, $key, 'HS256');
                $data->jwt = $jwt;
                $data->link = 'https://jitsi-invitrace.hyggecode.com/' . $room->name . '?jwt=' . $jwt . '';
            }
            // foreach($datas as $data){
            //     $data->mi= 1;
            // }
        }
        if (!$service) {
            return $this->returnErrorResponse(404, 'Service Not Found', 'SERVICE_NOT_FOUND');
        }

        return $this->returnDataResponse($service);
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
        $service = new Service;
        $service->name = $request->name;
        $service->key = Str::replace("-", "", Str::uuid());
        $service->organization_id = $request->organization_id;
        $service->active = $request->active;
        $service->picture = $request->picture; //base64string
        $service->limit_room = $request->limit_room;
        $service->created_user_id = $request->created_user_id;
        $service->updated_user_id = $request->updated_user_id;
        // $service->service_id = $request->service_id;
        // $service->save();
        if (!$service->save()) {
            return $this->returnErrorResponse(404, 'Service Not Insert', 'SERVICE_NOT_INSERT');
        }

        return $this->returnDataResponse($service);
    }

    public function organization(string $id)
    {
        $services = Service::where('organize_id', $id)->get();
        if (!$services) {
            return $this->returnErrorResponse(404, 'Service Not Found', 'SERVICE_NOT_FOUND');
        }

        return $this->returnDataResponse($services);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service =  Service::find($id);
        $service->name = $request->name;
        $service->active = $request->active;
        $service->limit_room = $request->limit_room;
        $service->updated_user_id = $request->updated_user_id;
        $service->picture = $request->picture;
        if (!$service->save()) {
            return $this->returnErrorResponse(404, 'Service Not Update', 'SERVICE_NOT_UPDATE');
        }

        return $this->returnDataResponse($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        if (!$service->delete()) {
            return $this->returnErrorResponse(404, 'Service Not Delete', 'SERVICE_NOT_DELETE');
        }

        return $this->returnDataResponse($service);
    }
}
