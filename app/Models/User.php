<?php


namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'birth_date',
        'email',
        'password',
        'avatar',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * This function returns the full name of the connected user
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }


    /**
     * This function returns the short name of the connected user
     * @return string
     */
    public function getShortNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name[0] . '.';
    }


    /**
     * Retrieve the school of the user
     */


    /**
     * @return (Model&object)|null
     */
    public function school() {
        // With this, the user can only have 1 school
        return $this->belongsToMany(School::class, 'users_schools')
            ->withPivot('role')
            ->first();
    }

    public function userSchools(): HasMany
    {
        return $this->hasMany(UserSchool::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'users_schools');
    }

    public function cohorts()
    {
        return $this->belongsToMany(Cohort::class, 'users_cohorts');
    }

    public static function getUserByRole(string $role, int $schoolId) {
        return self::leftJoin('users_schools as US', 'US.user_id', '=', 'users.id')
                        ->where('US.role', $role)
                        ->where('US.school_id', $schoolId)
                        ->select('users.*', 'US.role')
                        ->get();
    }
}
