<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Contact as cmodel;
use App\Countries;

class Contact extends Controller
{
    public function index(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    	'name'=>'required',
    	'group_id'=>'required',
    	'email'=>'required',
    	'skype_id'=>'required',
    	'phone'=>'required',
    	'country'=>'required',
    	'details'=>'required',
    		]);


    	if($validator->Fails())
    	{

    		return back()->withErrors($validator);
    	
    	}else
    	{
    		
    		$get_model = new cmodel();

    		if($get_model->check_group_id($request->input('group_id')))
    		{

    			$validator->errors()->add('group_id', 'Error: This Group Id already Exist..!');

    			return back()->withErrors($validator);

    		}else{

    			$get_model->insert_contact($request->all());

    			Session()->flash('successmsg','Contact Added Successfully...!');

            	return back();

    		}

    		
    	}


    }


    public function view_contacts()
    {

   
	
	return view('viewcontacts');    	


    }


    public function contacts_datatable(Request $request)
    {

    	$columns = array( 
                            0 =>'group_id', 
                            1 =>'name',
                            2=> 'email',
                            3=> 'skype_id',
                            4=> 'phone',
                            5=> 'country',
                            6=> 'created_at'
                        );
  
        $totalData = cmodel::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = cmodel::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  cmodel::where('group_id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('skype_id', 'LIKE',"%{$search}%")
                            ->orWhere('phone', 'LIKE',"%{$search}%")
                            ->orWhere('created_at', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = cmodel::where('group_id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('skype_id', 'LIKE',"%{$search}%")
                            ->orWhere('phone', 'LIKE',"%{$search}%")
                            ->orWhere('created_at', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                // $show =  route('posts.show',$post->id);
                // $edit =  route('posts.edit',$post->id);

                $nestedData['group_id'] ="<a href='".url('contact/edit/'.$post->id.'')."' target='_blank'>".$post->group_id."</a>";
                $nestedData['name'] = $post->name;
                $nestedData['email']=$post->email;
                $nestedData['skype_id']=$post->skype_id;
                $nestedData['phone']=$post->phone;
                $nestedData['country']=$post->country;
                $nestedData['created_at']=date("Y-m-d",strtotime($post->created_at));
                
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
        


    }



    public function edit_contact($id)
    {

        $data['countries'] = Countries::all();

        $sql = cmodel::where('id',$id)->get();

         $data['contact'] = $sql ;

        if($sql->count() > 0)
        {
            return view('editcontact',$data);
        }else{
            return redirect('contacts/view');
        }

    }

    public function update_contact_record(Request $request)
    {

        $validator = Validator::make($request->all(),[
        'name'=>'required',
        'group_id'=>'required',
        'email'=>'required',
        'skype_id'=>'required',
        'phone'=>'required',
        'country'=>'required',
        'details'=>'required',
            ]);


        if($validator->Fails())
        {

            return back()->withErrors($validator);
        
        }else
        {
            

            $get_model = new cmodel();

if($get_model->check_group_id_for_update($request->input('c_id'),$request->input('group_id')))
            {

                $validator->errors()->add('group_id', 'Error: This Group Id already Exist..!');

                return back()->withErrors($validator);

            }else{

                $get_model->update_contact($request->all());

                Session()->flash('successmsg','Contact Updated Successfully...!');

                return back();

            }

            
        }

    }
















}
