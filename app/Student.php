<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
class Student extends Model
{
    protected $table ="students";

    protected $fillable = [
    'student_name',
    'group_id',
    'student_fees',
    'gender',
    'class_type',
    'student_status',
    'class_time',
    'class_duration',
    'days',
    'details',
    '_token'
    ];


    public function insert_student($data)
    {
    	
    	$data['user_id'] = Auth::user()->id;
    	$data['days']=json_encode($data['days']);
    	Student::create($data);

    }

    public function update_student($id,$data)
    {
    	
    	$data['days']=json_encode($data['days']);
    	unset($data['stdid']);
    	Student::where('id',$id)->update($data);
    }


}
