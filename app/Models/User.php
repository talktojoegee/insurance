<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\HumanResource\Entities\Department;
use Modules\HumanResource\Entities\JobRole;
use Modules\HumanResource\Entities\EmploymentType;
use Modules\HumanResource\Entities\AcademicQualification;
use Modules\HumanResource\Entities\MaritalStatus;
use Modules\Policy\Entities\State;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public function employeeDepartment(){
        return $this->belongsTo(Department::class, 'department');
    }

    public function employeeJobRole(){
        return $this->belongsTo(JobRole::class, 'job_role');
    }

    public function employeeEmploymentType(){
        return $this->belongsTo(EmploymentType::class, 'employment_type');
    }
    public function employeeAcademicQualification(){
        return $this->belongsTo(AcademicQualification::class, 'academic_qualification');
    }
    public function employeeMaritalStatus(){
        return $this->belongsTo(MaritalStatus::class, 'marital_status');
    }

    public function getAllEmployees(){
        return User::where('visibility', 1)->orderBy('first_name', 'ASC')->get();
    }

    public function getAllActiveEmployees(){
        return User::where('account_status',1)->where('visibility', 1)->orderBy('first_name', 'ASC')->get();
    }

    public function getEmployeeBySlug($url){
        return User::where('visibility',1)->where('url', $url)->first();
    }

    public function getEmployeeState(){
        return $this->belongsTo(State::class, 'state');
    }

    public function getEmployeeLocalGovernment(){
        return $this->belongsTo(State::class, 'state');
    }

    public function updateEmployeeProfile(Request $request){
        $user =  User::find($request->empId);
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->mobile_no = $request->mobileNo ?? '';
        $user->gender = $request->gender ?? 1;
        $user->state = $request->state;
        $user->address = $request->address;
        $user->known_ailment = $request->knownAilment;
        $user->blood_group = $request->bloodGroup;
        $user->genotype = $request->genotype;
        $user->department = $request->department;
        $user->job_role = $request->jobRole;
        $user->academic_qualification = $request->qualification;
        $user->employee_id = $request->employeeId;
        $user->employment_type = $request->employmentType;
        $user->save();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
