<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInformation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['department', 'branch'];
    protected $appends = ['department_name', 'branch_name'];
    protected $hidden = ['student_number'];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function branch(){
        return $this->belongsTo(SchoolBranch::class, 'branch_id');
    }

    public function getDepartmentNameAttribute(){
        return $this->department->name ?? '';
    }

    public function getBranchNameAttribute(){
        return $this->branch->name ?? '';
    }
}
