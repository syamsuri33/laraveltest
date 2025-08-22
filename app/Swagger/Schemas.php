<?php

namespace App\Swagger;

//auth
/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * 
 * @OA\Schema(
 *     schema="TokenResponse",
 *     type="object",
 *     @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."),
 *     @OA\Property(property="token_type", type="string", example="Bearer")
 * )
 * 
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="Error message")
 * )
 * 
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     required={"email", "password"},
 *     @OA\Property(property="email", type="string", format="email", example="admin@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="password123")
 * )
 * 
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="password123", minLength=6)
 * )
 */

//parameter
/**
 * @OA\Schema(
 *     schema="Parameter",
 *     type="object",
 *     @OA\Property(property="param_code", type="string", example="GENDER"),
 *     @OA\Property(property="param_name", type="string", example="Jenis Kelamin"),
 *     @OA\Property(property="created_by", type="string", example="admin"),
 *     @OA\Property(property="created_time", type="string", format="date-time"),
 *     @OA\Property(property="updated_by", type="string", nullable=true, example=null),
 *     @OA\Property(property="updated_time", type="string", format="date-time", nullable=true),
 *     @OA\Property(
 *         property="details",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ParameterDetail")
 *     )
 * )
 * 
 * @OA\Schema(
 *     schema="ParameterDetail",
 *     type="object",
 *     @OA\Property(property="detail_code", type="string", example="M"),
 *     @OA\Property(property="detail_name", type="string", example="Laki-laki"),
 *     @OA\Property(property="param_code", type="string", example="GENDER"),
 *     @OA\Property(property="description", type="string", nullable=true, example=null),
 *     @OA\Property(property="created_by", type="string", example="admin"),
 *     @OA\Property(property="created_time", type="string", format="date-time"),
 *     @OA\Property(property="updated_by", type="string", nullable=true, example=null),
 *     @OA\Property(property="updated_time", type="string", format="date-time", nullable=true)
 * )
 */
class Schemas
{
    // Class ini hanya untuk menampung annotations Swagger
}