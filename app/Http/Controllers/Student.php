<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

use App\Student as smodel;

use Validator;

class Student extends Controller
{
    public function index()
    {

    	$data['group_ids'] = Contact::all();

    	return view('addstudents',$data);

    }

    public function add_student(Request $request)
    {

    	$valdator = Validator::make($request->all(),['student_name'=>'required',
    												 'group_id'=>'required']);

    	if($valdator->Fails())
    	{
    		
    		return back()->withErrors($valdator);
    	
    	}else{


    		$get_model = new smodel();

    		$get_model->insert_student($request->all());

    		Session()->flash('successmsg','A new Student Added Successfully...!');

            return back();


    	}


    }


    public function view_students()
    {


    	return view('viewstudents');	


    }


   

    public function students_datatable(Request $request)
    {

        $columns = array( 
                            0 =>'student_name', 
                            1 =>'group_id',
                            2=> 'gender',
                            3=> 'student_status',
                            4=> 'class_type',
                            5=> 'class_time',
                            6=> 'class_duration',
                            7=> 'days'
                        );
  
        $totalData = smodel::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = smodel::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  smodel::where('student_name','LIKE',"%{$search}%")
                            ->orWhere('group_id', 'LIKE',"%{$search}%")
                            ->orWhere('gender', 'LIKE',"%{$search}%")
                            ->orWhere('class_type', 'LIKE',"%{$search}%")
                            ->orWhere('student_status', 'LIKE',"%{$search}%")
                            ->orWhere('class_time', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = smodel::where('student_name','LIKE',"%{$search}%")
                            ->orWhere('group_id', 'LIKE',"%{$search}%")
                            ->orWhere('gender', 'LIKE',"%{$search}%")
                            ->orWhere('class_type', 'LIKE',"%{$search}%")
                            ->orWhere('student_status', 'LIKE',"%{$search}%")
                            ->orWhere('class_time', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
               
                

                

    
                $editstudent = url('student/edit/'.$post->id.'');
                $nestedData['student_name'] ="<a href=".$editstudent." target='_blank'>".$post->student_name."</a>";
                $nestedData['group_id'] = $post->group_id;
                $nestedData['gender']=$post->gender;
                $nestedData['student_status']=$post->student_status;
                $nestedData['class_type']=$post->class_type;
                $nestedData['class_time']=$post->class_time;
                $nestedData['class_duration']=$post->class_duration;
                $nestedData['days']=json_decode($post->days);
                
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


    public function edit_student_info($id)
    {
        
        $data['group_ids'] = Contact::all();

        $sql = smodel::where('id',$id)->get();

        if($sql->count() > 0)
        {

        $data['student_info']= $sql;

        return view('editstudent',$data);
            
        }else{
            
        return redirect('student/view');

        }

        
    }


    public function update_data(Request $request)
    {

        $valdator = Validator::make($request->all(),['student_name'=>'required',
                                                     'group_id'=>'required']);

        if($valdator->Fails())
        {
            
            return back()->withErrors($valdator);
        
        }else{


            $get_model = new smodel();

            $get_model->update_student($request->input('stdid'),$request->all());

            Session()->flash('successmsg','Student Information Updated Successfully...!');

            return back();


        }



    }






}
