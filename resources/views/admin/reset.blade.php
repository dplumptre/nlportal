@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger">Apply</div>

                <div class="card-body">





                @include('layouts.partials.errors')



<form class="form-inline" action="{{ route('admin.post.reset.leave')}}" method="post">
                         {{ csrf_field() }}

      <h3>Please read the informations below carefully before you click the reset button!</h3>

         <h4 style="margin-bottom: 10px; color: red" align="center"> The LEAVE RESET should be done once in a year. (preferably 01-01-20XX)                                  <br>
           Please note that you can not undo this action                          <br>
           Click the RESET button below if you are sure you want to carry out the reset for all users?         <br></h4>



<button type="submit"  onclick="javascript:return confirm('Are you sure you want to perform RESET?')"   class="btn btn-primary btn-lg" style="margin-top: 30px">RESET LEAVE COUNTER</button>
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
