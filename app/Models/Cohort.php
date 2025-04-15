<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $table        = 'cohorts';
    protected $fillable     = ['school_id', 'name', 'description', 'start_date', 'end_date'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_cohorts');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'users_cohorts');
    }

    public static function getCohortBySchoolId($schoolId) {
        return self::with(['students', 'school'])->where('school_id', $schoolId)->get();
    }
}
