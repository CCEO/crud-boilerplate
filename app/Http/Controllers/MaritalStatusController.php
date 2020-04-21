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
        $orderBy = request()->get("orderBy", 'id');
        $ascending = request()->get("ascending", 1);
        $filters = json_decode(request()->get("filters", "{}"), true);
        $columns = json_decode(request()->get("columns", "[]"), true);

        array_push($columns, 'id');
        $appends = ['formatted_created_at', 'formatted_updated_at'];

        $maritalStatuss = MaritalStatus::where("id", ">", 0);

        switch ($orderBy) {
            case 'formatted_created_at':
            case 'formatted_updated_at':
                $maritalStatuss->orderBy($orderBy == 'formatted_created_at' ? 'created_at' : 'update_at', $ascending ? "ASC" : "DESC");
                break;
            default:
                $maritalStatuss->orderBy($orderBy, $ascending ? "ASC" : "DESC");
                break;
        }

        foreach ($filters as $filter => $value) {
            if ($value && $filter != "reload")
                switch ($filter) {
                    case 'formatted_created_at':
                    case 'formatted_updated_at':
                        $filter = $filter == 'formatted_created_at' ? 'created_at' : 'update_at';
                        $dates = explode(" a ", $value);
                        if (count($dates) > 1)
                            $maritalStatuss = $maritalStatuss->whereBetween(DB::raw('DATE(' . $filter . ')'), [$dates[0], $dates[1]]);
                        else
                            $maritalStatuss = $maritalStatuss->whereDate($filter, $dates[0]);
                        break;
                    default:
                        $maritalStatuss->where($filter, 'LIKE', '%' . $value . '%');
                        break;
                }
        }

        $data = $maritalStatuss->get();
        $count = $data->count();
        if ($limit && $page)
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();

        $data = $data->map(function ($_data) use ($columns, $appends) {
            $_data = $_data->append($appends);
            $_data = $_data->only($columns);
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
