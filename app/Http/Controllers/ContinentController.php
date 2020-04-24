<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
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

        array_push($columns, 'id', 'name');
        $appends = ['formatted_created_at', 'formatted_updated_at'];

        $continents = Continent::where("id", ">", 0);

        switch ($orderBy) {
            case 'formatted_created_at':
            case 'formatted_updated_at':
                $continents->orderBy($orderBy == 'formatted_created_at' ? 'created_at' : 'update_at', $ascending ? "ASC" : "DESC");
                break;
            default:
                $continents->orderBy($orderBy, $ascending ? "ASC" : "DESC");
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
                            $continents = $continents->whereBetween($filter, [$dates[0], $dates[1]]);
                        else
                            $continents = $continents->whereDate($filter, $dates[0]);
                        break;
                    default:
                        $continents->where($filter, 'LIKE', '%' . $value . '%');
                        break;
                }
        }

        $data = $continents->get();
        $count = $data->count();
        if ($limit && $page)
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();

        $data = $data->map(function ($_data) use ($columns, $appends) {
            $_data = $_data->append($appends);
            if(count($columns)) $_data = $_data->only($columns);
            return $_data;
        });

        return compact("data", "count");
    }
}
