<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\ParameterDetail;
use Carbon\Carbon;
use App\Helpers\ApiResponse;
use App\Http\Requests\ParameterRequest;

class ParameterController extends Controller
{
    public function index(ParameterRequest $request)
    {
        try {
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');
            $query = Parameter::with('details');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('param_code', 'like', "%{$search}%")
                        ->orWhere('param_name', 'like', "%{$search}%");
                });
                $sortBy = $request->get('sort_by', 'param_code');
                //$sortOrder = $request->get('sort_order', 'asc');
                //$query->orderBy($sortBy, $sortOrder);
                $query->orderBy($sortBy);
            }

            $parameters = $query->paginate($perPage);

            return ApiResponse::pagination($parameters->items(), 'Parameters retrieved successfully', $parameters);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to retrieve parameters', 500, [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'param_code' => 'required|string',
            'param_name' => 'required|string',
        ]);

        $data['created_by'] = 'admin';
        $data['created_time'] = Carbon::now();

        return Parameter::create($data);
    }

    public function view($param_code)
    {
        return Parameter::with('details')->where('param_code', $param_code)->firstOrFail();
    }

    public function update(Request $request, $param_code)
    {
        $param = Parameter::findOrFail($param_code);
        $param->update([
            'param_name' => $request->param_name,
            'updated_by' => 'admin',
            'updated_time' => Carbon::now()
        ]);
        return $param;
    }

    public function delete($param_code)
    {
        Parameter::destroy($param_code);
        return response()->json(['message' => 'Deleted']);
    }
}
