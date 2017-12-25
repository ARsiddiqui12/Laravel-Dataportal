<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Countries;

use App\User;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['countries'] = Countries::all();

        return view('home',$data);
    }

    public function view_users()
    {

        return view('viewusers');

    }

    public function users_datatable(Request $request)
    {

        $columns = array( 
                            0 =>'name', 
                            1 =>'email',
                            2=> 'created_at',
                            3=> 'action'
                        );
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = User::where('id','<>',Auth::user()->id)
                         ->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  User::where('id','<>',Auth::user()->id)
                            ->where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('id','<>',Auth::user()->id)
                            ->where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
               
                

                

    
                $userdelete = url('user/delete/'.$post->id.'');
                $nestedData['name'] =$post->name;
                $nestedData['email'] = $post->email;
                $nestedData['created_at']=date("Y-m-d",strtotime($post->created_at));
                $nestedData['action']="<a href='".$userdelete."' class='btn btn-danger'><i class='fa fa-trash'></i> Delete</a>";
                
                
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


    public function delete_user($id)
    {

        User::where('id',$id)->delete();

        Session()->flash('successmsg','User Deleted Successfully...!');

        return redirect('users');
    }










}
