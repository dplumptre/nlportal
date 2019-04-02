@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger">Add User</div>

                <div class="card-body">






         

                @include('layouts.partials.errors')

<form method="post" action="{{ route('admin.post.user')}}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Name * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="name" placeholder="Enter Name" style="margin-bottom: 10px" type="text" value="{{old('name')}}" required/>
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Email Address * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" id="email" name="email" placeholder="choose email Address" style="margin-bottom: 10px" type="text" value="{{old('email')}}"  required/>
        </div>
    </div>


<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Password * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" type="password" id="password" name="password" placeholder="Enter password" style="margin-bottom: 10px" type="text" required/>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
             @endif
        </div>
</div>


    <div class="form-group">
        <label class="control-label col-md-4">Confirm password * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" type="password" id="password-confirm"  name="password_confirmation" placeholder="enter a password" style="margin-bottom: 10px" type="text" required/>
        </div>
    </div>

    <div class="form-group">
    <label class="control-label col-md-4"> Role </label>
    <table  style="margin-bottom: 10px">
    
        <td>            
            <label class="radio-inline">
              <input type="radio" name="role" id="role" value="staff" checked> Staff
            </label>

            <label class="radio-inline">
              <input type="radio" name="role" id="role" value="supervisor"> Supervisor
            </label>

            <label class="radio-inline">
              <input type="radio" name="role" id="role" value="admin"> Admin
            </label>

                </div>             
            </div>
        </td>
    </table>
</div>





<div class="form-group">
    <div id="advanced" style="display: block;">
        <label class="control-label col-md-4"> Assign Loan Role * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="loan_roles_id" style="margin-bottom: 10px"  >
                <option value="0">None</option>
                <option value="1">HR Admin</option>
                <option value="2">Payroll MGT</option>
                <option value="3">General Manager</option>
            </select>   
        </div>             
    </div>
</div>



    






    <div class="form-group">
        <label class="control-label col-md-4"> Department * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="department" required  style="margin-bottom: 10px">
                <option value=""> -- Select Department -- </option>
                @foreach($departments as $department) 
                    <option value="{{ $department->id }}"> {{ $department->name }} </option>
                @endforeach
            </select>
        </div>           
    </div>

    <div class="form-group">
        <label class="control-label col-md-4"> Grade * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="grade"  value="{{old('grade')}}"  style="margin-bottom: 10px">
                <option value=" " > -- Select Grade Level -- </option>
                @foreach($grades as $grade) 
                    <option value="{{ $grade->level }}"> {{ $grade->level }} </option>
                @endforeach
            </select>
        </div>             
    </div>


    <div class="form-group">
        <label class="control-label col-md-4"> Employee Type * </label>
        <div class="controls col-md-5 ">  
            <select class="input-md  textinput textInput form-control" name="employee_type"  value="{{old('employee_type')}}"  style="margin-bottom: 10px" >
                <option value=" " > --Select Type -- </option>
                 @foreach($employee_types as $type) 
                    <option value="{{ $type->employee_type }}"> {{ $type->employee_type }} </option>
                @endforeach
            </select>
        </div>             
    </div>

    <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Job Title * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="job_title"  placeholder="Enter Job Title" style="margin-bottom: 10px" type="text" id="job_title"  value="{{old('job_title')}}" />
             @if ($errors->has('job_title'))
                <span class="help-block">
                    <strong>{{ $errors->first('job_title') }}</strong>
                </span>
             @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('date_of_hire') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Date of Hire * </label>
        <div class="controls col-md-6 ">  
            <input class="input-md  textinput textInput form-control" id="date_of_hire" name="date_of_hire" placeholder="Date of Hire" style="margin-bottom: 10px" type="date"  value="{{old('date_of_hire')}}" />
             @if ($errors->has('date_of_hire'))
                <span class="help-block">
                    <strong>{{ $errors->first('date_of_hire') }}</strong>
                </span>
             @endif
        </div>
    </div>


     <div class="form-group{{ $errors->has('entitled') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Leave Entitlement * </label>
        <div class="controls col-md-3 ">  
            <input class="input-md  textinput textInput form-control" name="entitled"  placeholder="Days" style="margin-bottom: 10px" type="text" id="entitled"  value="{{old('entitled')}}" />
             @if ($errors->has('entitled'))
                <span class="help-block">
                    <strong>{{ $errors->first('entitled') }}</strong>
                </span>
             @endif
        </div>
    </div>



   <div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Create New Employee" class="btn btn-default btn btn-block" />
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
