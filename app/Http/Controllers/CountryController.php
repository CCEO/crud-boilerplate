<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        $appends = ['formatted_created_at', 'formatted_updated_at', 'continent_name'];

        $countries = Country::where("id", ">", 0);

        foreach ($filters as $filter => $value) {
            if ($value && $filter != "reload")
                switch ($filter) {
                    case 'formatted_created_at':
                    case 'formatted_updated_at':
                        $filter = $filter == 'formatted_created_at' ? 'created_at' : 'update_at';
                        $dates = explode(" a ", $value);
                        if (count($dates) > 1)
                            $countries = $countries->whereBetween($filter, [$dates[0], $dates[1]]);
                        else
                            $countries = $countries->whereDate($filter, $dates[0]);
                        break;
                    case "continent_name":
                        $countries->whereHas('continent', function ($record) use ($value) {
                            $record->where('name', 'like', "%" . $value . "%");
                        });
                        break;
                    default:
                        $countries->where($filter, 'LIKE', '%' . $value . '%');
                        break;
                }
        }

        $data = $countries->get();
        $count = $data->count();

        if ($ascending) {
            $data = $data->sortBy($orderBy)->values();
        } else {
            $data = $data->sortByDesc($orderBy)->values();
        }

        if ($limit && $page)
            $data = $data->slice(($page - 1) * $limit)->take($limit)->values();

        $data = $data->map(function ($_data) use ($columns, $appends) {
            $_data = $_data->append($appends);
            if(count($columns)) $_data = $_data->only($columns);
            return $_data;
        });

        return compact("data", "count");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request
     * @return Country
     */
    public function store(CountryRequest $request)
    {
        return Country::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Country
     */
    public function show($id)
    {
        return Country::findOrFail($id)
            ->append('formatted_created_at', 'formatted_updated_at', 'continent_name');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param $id
     * @return Country
     */
    public function update(CountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->fill($request->all());
        $country->save();
        return $country;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Country
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return $country;
    }
}
