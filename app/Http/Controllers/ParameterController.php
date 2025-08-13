<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\ParameterDetail;
use Carbon\Carbon;

class ParameterController extends Controller
{
    public function index()
    {
        return Parameter::with('details')->get();
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
