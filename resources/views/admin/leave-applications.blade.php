@extends('layouts.app')
@include('layouts.scripts.datatables_css')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-danger">Status</div>

                <div class="card-body">

                @include('layouts.partials.errors')

                


                <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center"><strike>N</strike>? </th>


                                  
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Action</th>
                               
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"  style="width: 20%"><a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Approve/Dissaprove leave as supervisor"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"> {{ $request->working_days_no }}</td>
                <td class="text-center"> {{ $request->reason }}</td>
                <td class="text-center" style="width: 3%"> <small><?php   getAllowance($request->allowance) ?></small></td>





                <td class="text-center" style="width: 9%">
                    <a style="text-decoration: none; color: #ffffff" href="{{ asset('supervisor/'.$request->id.'/edit') }} "   data-toggle="tooltip" title="Unit Head Approval" style> 
                        <div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} 
                    </a> 
                </td>

            <td class="text-center">
                <a style="text-decoration: none; color: #ffffff" href="{{ asset('admin/'.$request->id.'/admin-edit') }}"  data-toggle="tooltip" title="HR Approval">
                <div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} 
                </a> 
            </td>
<td class="text-center">
    <a href="{{ asset('admin/'.$request->user_id.'/history')}}"  data-toggle="tooltip" title="View Leave History">
        <i class="fa fa-calendar fa-3"  style="padding-right: 10px"></i>
    </a>
    <a href="{{ asset('admin/'.$request->id.'/admin-edit') }}"  data-toggle="tooltip" title="Approve/Dissaprove Leave as HR">
        <i class="fa fa-check-circle fa-3" ></i>
    </a>
   
</td>

</tr>
                    @endforeach

        </tbody>
    </table>





                </div>




            </div>
        </div>
    </div>
</div>
@endsection




@push('scripts')
@include('layouts.scripts.sites_js')
@include('layouts.scripts.datatables_js')

@endpush