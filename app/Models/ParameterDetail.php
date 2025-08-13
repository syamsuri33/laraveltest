<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParameterDetail extends Model
{
    protected $primaryKey = 'detail_code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'detail_code', 'detail_name', 'param_code', 'description',
        'created_by', 'created_time', 'updated_by', 'updated_time'
    ];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class, 'param_code', 'param_code');
    }
}
