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

            @if($users->leaves()->count()==0)
            <div class="panel-heading" align="center" style="color: red"> <h5> You have not applied for any leave </h5></div>

            @else

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR/Admin</th>
                                        <th class="text-center">Form</th>
                                        <th class="text-center"><i class="fa fa-comments fa-2"></i> </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>

    @foreach($users->leaves() as $key =>$user)
    <tr>
    <td class="text-center" style="width: 1%" >{{ $key + 1 }}</td>
    <td class="text-center" style="width: 20%" >{{ $user->name }}</td>
    <td class="text-center" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($user->leave_starts)) }} </small></td>
    <td class="text-center" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($user->leave_ends)) }} </small></td>
    <td class="text-center">{{ $user->working_days_no }} </td>
    <td class="text-center" style="width: 12%" ><div class=<?php status($user->approval_status); ?> > {{ $user->approval_status }} </td>
    <td class="text-center"><div class=<?php status1($user->admin_approval_status); ?> > {{ $user->admin_approval_status }} </td>
    <td class="text-center"style="width: 5%" >

    @if(!($user->approval_status == "Approved" || $user->approval_status == "Rejected"))
    <a href="{{ asset('leave_delete/'.$user->id )}}"  onclick="javascript:return confirm('Are you sure to delete this leave application?')" data-toggle="tooltip" title="Delete Leave Application">
    <i class="fa fa-trash fa-2" style="color: red"></i>  
    </a>
    @elseif($user->resumed_on) 

    <i class="fa fa-check-circle fa-2"></i> 

    @elseif(($user->approval_status == "Approved") && ($user->admin_approval_status == "Approved"))

    <a href="{{ asset('leave_return/edit/'.$user->id)}}"  data-toggle="tooltip" title="Leave return form">
    <i class="fa fa-table fa-2"></i> 
    </a>

    @else
    
    @endif
    </td>
    <td class="text-center"style="width: 15%" > {{ $user->admin_remark }} </td>
    </tr>
    @endforeach

     

        </tbody>
    </table>




            @endif





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