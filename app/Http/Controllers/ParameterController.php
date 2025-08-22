<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Models\ParameterDetail;
use Carbon\Carbon;
use OpenApi\Annotations as OA;
use App\Swagger\Schemas; // Import class Schemas
use App\Helpers\ApiResponse; // Import helper response

/**
 * @OA\Info(
 *     title="Parameter API",
 *     version="1.0.0"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class ParameterController extends Controller
{
  /**
   * @OA\Get(
   *     path="/api/parameters",
   *     summary="Get all parameters",
   *     tags={"Parameters"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Response(
   *         response=200,
   *         description="List of parameters",
   *         @OA\JsonContent(
   *             type="array",
   *             @OA\Items(ref="#/components/schemas/Parameter")
   *         )
   *     )
   * )
   */
  public function index(Request $request)
  {
    $perPage = $request->get('per_page', 10);
    $parameters = Parameter::with('details')->paginate($perPage);

    return ApiResponse::pagination($parameters->items(), 'Parameters retrieved successfully', $parameters);
  }

  /**
   * @OA\Post(
   *     path="/api/parameters",
   *     summary="Create new parameter",
   *     tags={"Parameters"},
   *     security={{"bearerAuth":{}}},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"param_code","param_name"},
   *             @OA\Property(property="param_code", type="string", example="GENDER"),
   *             @OA\Property(property="param_name", type="string", example="Jenis Kelamin")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Parameter created successfully",
   *         @OA\JsonContent(ref="#/components/schemas/Parameter")
   *     ),
   *     @OA\Response(
   *         response=422,
   *         description="Validation error"
   *     )
   * )
   */
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

  /**
   * @OA\Get(
   *     path="/api/parameters/{code}",
   *     summary="Get parameter by code",
   *     tags={"Parameters"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Parameter(
   *         name="code",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="string")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Parameter details",
   *         @OA\JsonContent(ref="#/components/schemas/Parameter")
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Parameter not found"
   *     )
   * )
   */
  public function view($param_code)
  {
    return Parameter::with('details')->where('param_code', $param_code)->firstOrFail();
  }

  /**
   * @OA\Put(
   *     path="/api/parameters/{code}",
   *     summary="Update parameter",
   *     tags={"Parameters"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Parameter(
   *         name="code",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="string")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"param_name"},
   *             @OA\Property(property="param_name", type="string", example="Updated Name")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Parameter updated successfully",
   *         @OA\JsonContent(ref="#/components/schemas/Parameter")
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Parameter not found"
   *     )
   * )
   */
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

  /**
   * @OA\Delete(
   *     path="/api/parameters/{code}",
   *     summary="Delete parameter",
   *     tags={"Parameters"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Parameter(
   *         name="code",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="string")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Parameter deleted successfully",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Deleted")
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Parameter not found"
   *     )
   * )
   */
  public function delete($param_code)
  {
    Parameter::destroy($param_code);
    return response()->json(['message' => 'Deleted']);
  }
}
