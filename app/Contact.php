<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    protected $table ="contacts";

    protected $fillable = ['user_id','name','group_id','email','skype_id','phone','country','details','_token','created_at'];

    public function check_group_id($group_id)
    {

    $check = Contact::where('group_id',$group_id)->get()->count();

    return $check;

    }

    public function insert_contact($data)
    {
    	$data['user_id'] = Auth::user()->id;

    	Contact::create($data);
    }

    public function update_contact($data)
    {
        $id = $data['c_id'];

        unset($data['c_id']);

        Contact::where('id',$id)->update($data);

    }

    public function check_group_id_for_update($id,$group_id)
    {

    $check = Contact::where('id','<>',$id)->where('group_id','=',$group_id)->get()->count();

    return $check;

    }
}
