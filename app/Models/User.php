<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Modules\CompanySettings\Entities\SettingsGeneral;
use Modules\HumanResource\Entities\BloodGroup;
use Modules\HumanResource\Entities\Department;
use Modules\HumanResource\Entities\JobRole;
use Modules\HumanResource\Entities\EmploymentType;
use Modules\HumanResource\Entities\AcademicQualification;
use Modules\HumanResource\Entities\MaritalStatus;
use Modules\Policy\Entities\State;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

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
        return User::where('visibility', 1)->orderBy('id', 'DESC')->get();
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

    public function getBloodGroup(){
        return $this->belongsTo(BloodGroup::class, 'blood_group');
    }

    public function getEmployeeLocalGovernment(){
        return $this->belongsTo(LocalGovernment::class, 'lga');
    }

    public function getUserById($id){
        return User::find( $id);
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

    public function updateAccountStatus(Request $request){
        $user = User::find($request->employeeId);
        $user->account_status = $request->status;
        $user->save();
    }

    public function addEmployee(Request $request, $password){
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->other_names = $request->other_names;
        $user->email = $request->email_address;
        //$user->official_email = $request->official_email;
        $user->mobile_no = $request->mobile_no;
        $user->gender = $request->gender;
        $user->marital_status = $request->marital_status;
        $user->state = $request->state_of_origin;
        $user->lga = $request->lga ?? '';
        $user->address = $request->residential_address;
        $user->birth_date = $request->birth_date;
        $user->known_ailment = $request->known_ailment;
        $user->blood_group = $request->blood_group;
        $user->genotype = $request->genotype ?? 1; //not in use
        $user->department = $request->department;
        $user->job_role = $request->job_role;
        $user->url = substr(sha1(time()), 11,40);
        //$user->grade = $request->grade;
        $user->academic_qualification = $request->academic_qualification;
        $user->employee_id = $request->employee_id;
        $user->employment_type = $request->employment_type;
        $user->hire_date = $request->hire_date;
        $user->role = $request->application_access_level;
        $user->password = bcrypt($password);
        $user->save();
        return $user;
    }

    public function uploadProfilePicture($avatarHandler){
        $filename = $avatarHandler->store('avatars', 'public');
        $avatar = User::find(Auth::user()->id);
        if($avatar->image != 'avatars/avatar.png'){
            $this->deleteFile($avatar->avatar); //delete file first
        }
        $avatar->avatar = $filename;
        $avatar->save();
    }

    public function deleteFile($file){
        if(\File::exists(public_path('storage/'.$file))){
            \File::delete(public_path('storage/'.$file));
        }
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
