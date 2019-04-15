@extends('layouts.app')
@include('layouts.scripts.datatables_css')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger">ALL EMPLOYEES</div>

                <div class="card-body">


                @include('layouts.partials.errors')




<table id="example" class="table-responsive table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Dept</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Date of Hire</th>
            <th class="text-center"><a href="{{ asset('admin/add-user')}}" data-toggle="tooltip" title="Create New User"> 
           <i class="fa fa-user-plus fa-2" ></i> </th>
                    </tr>
                </thead>
                
                 
                <tbody>
            <?php $rows = 0; ?>         
@foreach($employees as $employee)
<tr>
<td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
<td class="text-center" style="width: 30%" > {{ $employee->name }}</td>
<td class="text-center">{{ $employee->departments->name }}</td>
<td class="text-center">
@foreach($employee->roles as $role)
{{ $role->role }} /
@endforeach
</td>
<td class="text-center"><small>{{ date('d-M-Y ', strtotime($employee->date_of_hire)) }} </small></td>
<td class="text-center">
<a href="#" data-toggle="tooltip" title="View User">
<i class="fa fa-eye fa-2" style="padding-right: 8px; padding-left: 8px;"></i> 
</a>
<a href="{{ asset('admin/view-user/'.$employee->id.'/edit') }}" data-toggle="tooltip" title="Edit User">
<i class="fa fa-edit fa-2" style="padding-right: 8px; padding-left: 8px;"></i> 
</a>
<a href="{{ asset('admin/delete-user/'.$employee->id ) }}" onclick="javascript:return confirm('Are you sure to delete {{$employee->name }}')"  data-toggle="tooltip" title="Delete User">
<i class="fa fa-trash fa-2" style="padding-right: 8px; padding-left: 8px; color: red"></i> 
</a>
</td>

</tr>
@endforeach


     </tbody>
   </table>
</div>




@push('scripts')
@include('layouts.scripts.sites_js')
@include('layouts.scripts.datatables_js')
@endpush
































            </div>
        </div>
    </div>
</div>
@endsection
