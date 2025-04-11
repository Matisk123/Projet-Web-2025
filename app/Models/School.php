<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class School extends Model
{
    protected $table        = 'schools';
    protected $fillable     = ['user_id', 'name', 'description'];


    public function cohort()
    {
        return $this->hasMany(Cohort::class);
    }
}
