@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger">Apply</div>

                <div class="card-body">






                <table class="table" style="border: none;">

<div>
    <tr> <td><b>Name</td> <td><div  class="btn btn-success btn-xs">{{ $users->name }} </td> <td></td> <td></td></tr>
    <tr> <td><b>Department</td> <td>{{ $users->department }} </td> <td></td>  <td></td></tr>

</div>
<tr class="info"> <td> <b>Leave Details </b></td> <td> </td>  <td></td> <td></td></tr>
<div>

    <tr> <td><b>Leave Type</td> <td>{{ $users->leave_type }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Leave Starts</td> <td><div  class="btn btn-info btn-xs"><small>{{ date('d-M-Y ', strtotime($users->leave_starts)) }} </small> </td>  <td>Leave Ends:</td><td><div  class="btn btn-danger btn-xs"><small>{{ date('d-M-Y ', strtotime($users->leave_ends)) }} </small> </td></tr>
    <tr> <td><b>Reason for going on leave</td> <td>{{ $users->reason }} </div></td> <td></td> <td> </td> </tr>
  
    <tr> <td><b>No of days</td> <td><div  class="btn btn-warning btn-xs">{{ $users->working_days_no }} </td>  <td></td> <td></td></tr>
    
    <tr> <td><b>Resumption Date</td> <td><div  class="btn btn-info btn-xs"><small>{{ date('d-M-Y ', strtotime($users->resumption_date)) }} </small> </td> <td></td>  <td></td></tr>

    <tr> <td><b>Name of Reliever</td> <td>{{$users->reliever_name }} </td> <td></td>  <td></td></tr>

    <tr> <td><b>Mobile <b></td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
</div>

<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="danger"> <td colspan="4"> <b>Unit Head Approval Status </b></td></tr>
     <tr> <td><b>Name of Unit Head</td> <td><div  class="btn btn-success btn-xs">{{ $users->unit_head_name }} </div></td> <td></td> <td> </td> </tr>

<tr> <td><b>Date Approved:</td> <td>{{ $users->date_unithead_approved }} </div></td> <td></td> <td> </td> </tr>

<tr> <td><b>Signed by:</td> <td>{{ $users->signature }} </div></td> <td></td> <td> </td> </tr>

<tr> <td><b>Remark:</td> <td>{{ $users->unithead_remark }} </div></td> <td></td> <td> </td> </tr>


<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="success"> <td colspan="4" align="center"> <b>ADMIN APPROVAL </b>
 

</td></tr>

</table>           
         



<form method="post" action="{{ asset('admin/'.$users->id.'/admin-edit')}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}


<div class="form-group{{ $errors->has('hr_signature') ? ' has-error' : '' }}">
         <div id="div_id_terms" class="checkbox required">
            <label for="hr_signature" class=" requiredField">
                <input class="input-ms checkboxinput" id="hr_signature" name="hr_signature" style="margin-bottom: 10px" type="checkbox" value="{{ Auth::user()->email }}" />
                         I <em class="info" style="color: red; padding-right: 10px"> {{ Auth::user()->name }} </em> Approves/Dissaproves this leave request

                          @if ($errors->has('hr_signature'))
                <div class="help-block" style="color: red;">
                    <strong>{{ $errors->first('hr_signature') }}</strong>
                </div>
             @endif
            </label>
        </div>                             
</div>  



    <div class="form-group">
        <label class="control-label col-md-4"> Admin Approval * </label>
        <div class="controls col-md-8 ">  
            <select class="input-md  textinput textInput form-control" id="admin_approval_status"  name="admin_approval_status" value="{{ $users->working_days_no }}" onblur="copyValue()" required  style="margin-bottom: 10px">
                    <option >{{ $users->admin_approval_status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
            </select>   
        </div>             
    </div>   



<input type="hidden" name="days_hr_approved" id="days_hr_approved" readonly />

<script type="text/javascript">
    function copyValue(){
        if (admin_approval_status.value=="Approved") {
            days_hr_approved.value = {{ $users->working_days_no }};
          }
        else{
            days_hr_approved.value = 0;
        }

      }
</script>



<input type="hidden" name="date_admin_approved" readonly value="<?php echo date('d-m-y h:i');?>" >

<input type="hidden" name="user_id" value="{{$users->user_id}}" readonly="">
<input type="hidden" name="applicant_email" value="{{$applicant_email}}" readonly="">

<div class="form-group"> <div class=" controls col-md-4 "></div>
    <div class="controls col-md-8 ">
       
        <input type="submit" name="create" value="Submit" class="btn btn-secondary btn-lg" />
    </div>
</div> 
         

</form>











 </div>

 @push('scripts')
@include('layouts.scripts.sites_js')
@endpush

































            </div>
        </div>
    </div>
</div>
@endsection
