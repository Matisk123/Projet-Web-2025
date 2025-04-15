<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCohort extends Model
{
    protected $table        = 'users_cohorts';
    protected $fillable     = ['user_id', 'cohort_id'];
}
