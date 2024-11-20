<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organization = Organization::all()->toQuery();
        if (!$organization) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        $orderByColumn = (request()->has('sort_by')) ? request()->input('sort_by') : 'random';
        $orderByDirection = (request()->has('order_by')) ? request()->input('order_by') : 'ASC';
        if ($orderByColumn === 'random') {
            $organization->inRandomOrder();
        } else {
            $organization->orderBy($orderByColumn, $orderByDirection);
        }


        // Paging
        $per_page = (request()->has('per_page') ? request()->input('per_page') : 10);
        $offset = (request()->has('offset') ? request()->input('offset') : 0);
        $page = floor($offset / $per_page) + 1;
        $organizations = $organization->paginate($per_page, ['*'], null, $page);
        return $this->returnDataWithPageResponse($organizations,['sort_by' => $orderByColumn,'order_by' => $orderByDirection]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $organizations = Organization::find($id);

        if (!$organizations) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        return $this->returnDataResponse($organizations);
    }

    public function showServices(string $id)
    {
        $organizations = Organization::find($id);
        $organizations->services;

        if (!$organizations) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        return $this->returnDataResponse($organizations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organization = new Organization;
        $organization->name = $request->name;
        $organization->picture = $request->picture; //base64string
        $organization->email = $request->email;
        $organization->phone = $request->phone;
        $organization->created_user_id = $request->created_user_id;
        $organization->updated_user_id = $request->updated_user_id;
        $organization->active = $request->active;
        if (!$organization->save()) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        return $this->returnDataResponse($organization);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $organizations = Organization::find($id);
        $organizations->name = $request->name;
        $organizations->picture = $request->picture;
        $organizations->email = $request->email;
        $organizations->phone = $request->phone;
        $organizations->updated_user_id = $request->updated_user_id;
        $organizations->active = $request->active;
        if (!$organizations->save()) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        return $this->returnDataResponse($organizations);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organizations = Organization::find($id);
        if (!$organizations->delete()) {
            return $this->returnErrorResponse(404, 'Organization Not Found', 'ORGANIZATION_NOT_FOUND');
        }

        return $this->returnDataResponse($organizations);
    }
}
