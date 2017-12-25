@extends('layouts.app')

@push('style')
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@endpush


@section('content')



<section id="main-content">
<section class="wrapper">
<div class="form-w3layouts">        
<div class="row">
<div class="col-lg-12">

<section class="panel">
                        <header class="panel-heading">
                          View Contacts
                        </header>
                        <div class="panel-body">
                           
        @if(Session('successmsg'))

        <div class="alert alert-success alert-dismissable">
        
        <strong>Success: </strong> {{ Session('successmsg') }}
        </div>

        @endif

<table id="contactlist" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>GroupId</th>
                <th>Name</th>
                <th>Email</th>
                <th>Skype</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Date</th>
            </tr>
        </thead>


</table>







                        
                            
                        </div>
                    </section>





































</div>
</div>
</div>
</section>
</section>
@endsection

@push('scripts')
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
 <script type="text/javascript">
 	
 	    $(document).ready(function () {

        $('#contactlist').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('contactdatatable') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "group_id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "skype_id" },
                { "data": "phone" },
                { "data": "country"},
                { "data": "created_at"}
            ]	 

        });
    });

 </script>
@endpush






