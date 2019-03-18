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



 <style>

th, td {
  padding: 15px;
  text-align: left;
}
</style>


                @if($requests->count()==0)
            <div class="panel-heading" align="center" style="color: red"> <h5> You have not applied for any leave </h5></div>

            @else

            <table id="example" class="" style="width:100%">
            <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Confirm</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>

      @foreach($requests as  $key => $request)
    <td class="text-center" style="width: 1%" >{{ $key + 1 }}</td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;width: 20%; padding: 15px;" ><a href="{{ asset('supervisor/'.$request->id.'/edit') }}"   data-toggle="tooltip" title="Click to Approve Leave"> {{ $request->name }}</a></td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;width: 12%" ><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;width: 12%" ><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;width: 15%" >{{ $request->reason }}</td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;width: 11%" >
                    <a href="{{ asset('supervisor/'.$request->id.'/edit')}}"   data-toggle="tooltip" title="Click to Approve Leave"> 
                        <div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </div>
                    </a>
                </td>
                <td class="text-center"  style=" border-bottom: 1px solid #ddd;padding: 15px;"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;"><small><em>
                   @if($request->returnee_signature)
                    Resumed
                   @endif
                </td></small></em>

                <td class="text-center"> 
                    @if($request->super_confirm_signature)
                        <i class="fa fa-check-circle" style="color: green"></i>
                    @endif
                </td>
                <td class="text-center" style=" border-bottom: 1px solid #ddd;padding: 15px;">
                    @if($request->returnee_timestamp)
                    <a href="#"  data-toggle="tooltip" title="Confirm Staff Resumption"> 
                	<i class="fa fa-check-circle fa-2x"></i> </a>
                    @endif
                </td>
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