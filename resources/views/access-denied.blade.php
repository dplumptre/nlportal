@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger">ACCESS DENIED</div>

                <div class="card-body">
             
                <i class="fa fa-ban fa-5x"></i> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('layouts.scripts.sites_js')
@endpush