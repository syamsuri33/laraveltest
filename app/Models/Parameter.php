<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
  protected $table = 'parameter';
  protected $primaryKey = 'param_code';
  public $incrementing = false;
  protected $keyType = 'string';
  public $timestamps = false;

  protected $fillable = [
    'param_code',
    'param_name',
    'created_by',
    'created_time',
    'updated_by',
    'updated_time'
  ];

  public function details()
  {
    return $this->hasMany(ParameterDetail::class, 'param_code', 'param_code');
  }
}
