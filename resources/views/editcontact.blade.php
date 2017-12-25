@extends('layouts.app')

@push('style')
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
@endpush

@section('content')


<section id="main-content">
<section class="wrapper">
<div class="form-w3layouts">        
<div class="row">
<div class="col-lg-12">

<section class="panel">
                        <header class="panel-heading">
                          Edit Contact
                        </header>
                        <div class="panel-body">
                           
        @if(Session('successmsg'))

        <div class="alert alert-success alert-dismissable">
        
        <strong>Success: </strong> {{ Session('successmsg') }}
        </div>

        @endif

        @foreach($contact as $rw)
                        <form method="post" action="{{ route('contact.update') }}">
                                 
        <div class="row">
                            
        <div class="col-md-4">

        <label>Name</label>
        <input type="text" name="name" value="{{$rw->name}}" placeholder="Name" class="form-control" required="required">
        <input type="hidden" name="c_id" value="{{$rw->id}}">
        </div>

        <div class="col-md-4">

        <label>Group Id</label>
        <input type="number" name="group_id" value="{{$rw->group_id}}" placeholder="Group Id" class="form-control" required="required">
         @if($errors->has('group_id'))
         <span style="color:red;">{{$errors->first('group_id')}}</span>
         @endif
        </div>

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-4">

        <label>Email</label>
        <input type="email" name="email" value="{{$rw->email}}" placeholder="Email Address" class="form-control" required="required">

        </div>

        <div class="col-md-4">

        <label>Skype</label>
        <input type="text" name="skype_id" value="{{$rw->skype_id}}" placeholder="Skype Address" class="form-control" required="required">

        </div>

        </div>


        <br>

        <div class="row">
                            
        <div class="col-md-4">

        <label>Phone</label>
        <input type="number" name="phone" value="{{$rw->phone}}" placeholder="Phone" class="form-control" required="required">

        </div>

        <div class="col-md-4">

        <label>Country</label>
        <select class="form-control js-example-basic-single" name="country" required="required">
            <option value="" selected="selected">Select Country</option>
            @foreach ($countries as $record)
            <option value="{{$record->country_name}}" @if($record->country_name==$rw->country) selected @endif>{{$record->country_name}}</option>
            @endforeach
        </select>

        </div>

        </div>

        <br>

        <div class="row">
                            
        <div class="col-md-8">

        <label>Additional Details</label>
        <textarea rows="6" name="details" class="form-control" required="required">
        	{{$rw->details}}
        </textarea>

        </div>

        </div>
        <br>
          <div class="row">
                            
        <div class="col-md-8">

        <button class="btn btn-info pull-right">Add Contact</button>

        </div>

        </div>

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

<script type="text/javascript">
    
    $(document).ready(function(){

         $('.js-example-basic-single').select2();

    });

</script>

@endpush