<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaritalStatusRequest;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return array
     */
    public function index()
    {
        $page = request()->get("page", false);
        $limit = request()->get("limit", false);
        $filters = json_decode(request()->get("filters", "{}"), true);

        $maritalStatuss = MaritalStatus::where("id", ">", 0);

        foreach ($filters as $filter => $value) {
            if ($value && $filter != "reload")
                $maritalStatuss->where($filter, $value);
        }

        $data = $maritalStatuss->get();
        $count = $data->count();
        if ($limit && $page)
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();

        $data = $data->map(function ($_data){
            $_data = $_data->append('formatted_created_at', 'formatted_updated_at');
            return $_data;
        });

        return compact("data", "count");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MaritalStatusRequest $request
     * @return MaritalStatus
     */
    public function store(MaritalStatusRequest $request)
    {
        $data = $request->all();
        return MaritalStatus::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return MaritalStatus
     */
    public function show($id)
    {
        return MaritalStatus::findOrFail($id)
            ->append('formatted_created_at', 'formatted_updated_at');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MaritalStatusRequest $request
     * @param $id
     * @return MaritalStatus
     */
    public function update(MaritalStatusRequest $request, $id)
    {
        $maritalStatus = MaritalStatus::findOrFail($id);
        $data = $request->all();
        $maritalStatus->fill($data);
        $maritalStatus->save();
        return $maritalStatus;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return MaritalStatus
     */
    public function destroy($id)
    {
        $maritalStatus = MaritalStatus::findOrFail($id);
        $maritalStatus->delete();
        return $maritalStatus;
    }
}
