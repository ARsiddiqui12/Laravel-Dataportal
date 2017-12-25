@extends('layouts.app')

@push('style')
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@endpush

@section('content')


<section id="main-content">
<section class="wrapper">
<div class="form-w3layouts">        
<div class="row">
<div class="col-lg-12">

<section class="panel">
                        <header class="panel-heading">
                          Edit Student Information
                        </header>
                        <div class="panel-body">
                           
        @if(Session('successmsg'))

        <div class="alert alert-success alert-dismissable">
        
        <strong>Success: </strong> {{ Session('successmsg') }}
        </div>

        @endif

        

        @foreach($student_info as $rw)

        <form method="post" action="{{ route('student.update') }}">
        <input type="hidden" name="stdid" value="{{$rw->id}}">           
        <div class="row">
                            
        <div class="col-md-4">

        <label>Student Name</label>
        <input type="text" name="student_name" value="{{$rw->student_name}}" placeholder="Name" class="form-control" required="required">

        </div>

        <div class="col-md-4">

        <label>Group Id</label>
        <select name="group_id" class="form-control js-example-basic-single" required="required">
            
            <option value="" selected="selected">Select Group Id</option>

            @forelse($group_ids as $record)

            <option value="{{$record->group_id}}" @if($rw->group_id==$record->group_id) selected @endif>{{$record->name." (".$record->group_id." )"}}</option>

            @empty

            <option value="" selected="selected">Any Group Id not found..</option>

            @endforelse

        </select>
         @if($errors->has('group_id'))
         <span style="color:red;">{{$errors->first('group_id')}}</span>
         @endif
        </div>

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-4">

        <label>Fees</label>
        <input type="number" name="student_fees" value="{{$rw->student_fees}}" placeholder="Name" class="form-control" required="required">

        </div>

        <div class="col-md-4">

        <label>Gender</label>
        <select name="gender" class="form-control" required="required">
            
        <option value="" selected="selected">Select Gender</option>
        <option value="Male" @if($rw->gender=="Male") selected @endif>Male</option>
        <option value="Female" @if($rw->gender=="Female") selected @endif>Female</option>

        </select>
        
        </div>

        </div>

        <br>


        <div class="row">
                            
        <div class="col-md-4">

        <label>Class Type</label>
        <select name="class_type" class="form-control" required="required">
            
<option value="" selected="selected">Select Class Type</option>
<option value="Trial" @if($rw->class_type=="Trial") selected @endif>Trial</option>
<option value="Regular" @if($rw->class_type=="Regular") selected @endif>Regular</option>

        </select>

        </div>

        <div class="col-md-4">

        <label>Status</label>
        
        <select name="student_status" class="form-control" required="required">
            
<option value="" selected="selected">Select Status</option>
<option value="Active" @if($rw->student_status=="Active") selected @endif>Active</option>
<option value="Inactive" @if($rw->student_status=="Inactive") selected @endif>Inactive</option>
<option value="Close" @if($rw->student_status=="Close") selected @endif>Close</option>
<option value="Leave" @if($rw->student_status=="Leave") selected @endif>Leave</option>

        </select>


        </div>

        </div>

        <br>


<div class="row">
                            
        <div class="col-md-4">

        <label>Class Time</label>
        <input type="text" id="timepicker4" value="{{$rw->class_time}}" name="class_time" placeholder="Name" class="form-control" required="required">

        </div>

        <div class="col-md-4">

        <label>Class Duration</label>
        
        <select name="class_duration" class="form-control" required="required">
            
<option value="" selected="selected">Select Class Duration</option>
<option value="20" @if($rw->class_duration=="20") selected @endif>20</option>
<option value="30" @if($rw->class_duration=="30") selected @endif>30</option>
<option value="45" @if($rw->class_duration=="45") selected @endif>45</option>
<option value="60" @if($rw->class_duration=="60") selected @endif>60</option>

        </select>


        </div>

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-8">

        <label>Days</label>
        <select class="form-control js-example-basic-multiple" multiple="multiple" name="days[]" required="required">
            
<option value="Mon" @if(in_array("Mon",json_decode($rw->days))) selected @endif>Mon</option>
<option value="Tue" @if(in_array("Tue",json_decode($rw->days))) selected @endif>Tue</option>
<option value="Wed" @if(in_array("Wed",json_decode($rw->days))) selected @endif>Wed</option>
<option value="Thu" @if(in_array("Thu",json_decode($rw->days))) selected @endif>Thu</option>
<option value="Fri" @if(in_array("Fri",json_decode($rw->days))) selected @endif>Fri</option>
<option value="Sat" @if(in_array("Sat",json_decode($rw->days))) selected @endif>Sat</option>
<option value="Sun" @if(in_array("Sun",json_decode($rw->days))) selected @endif>Sun</option>

        </select>

        </div>

      

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-8">

        <label>Additional Information</label>
        <textarea class="form-control" rows="6" name="details" required="required">
            {{$rw->details}}
        </textarea>

        </div>

      

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-8">

        <button type="submit" class="btn btn-success pull-right">Add Student</button>

        </div>

      

        </div>

        <br>


        {{ csrf_field() }}



                        </form>

        @endforeach
                            
                        </div>
                    </section>





































</div>
</div>
</div>
</section>
</section>
@endsection

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){

         $('.js-example-basic-single').select2();
         $('.js-example-basic-multiple').select2();
         $('#timepicker4').timepicker({
               
            });

    });

</script>

@endpush