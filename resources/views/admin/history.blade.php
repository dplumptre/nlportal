@extends('layouts.app')
@include('layouts.scripts.datatables_css')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-danger">Status</div>

                    <div class="card-body">







                        <div class="panel-heading">
                            <h3> <i class="fa fa-calendar fa-2x" style="padding-right: 10px"></i>
                                {{ $users->name }}
                                <div class="pull-right"> <a href="/admins/users/{{ $users->id }}" data-toggle="tooltip"
                                        title="View full User datail">
                                    </a>
                                </div>
                            </h3>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('[data-toggle="tooltip"]').tooltip();
                            });

                        </script>

                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <?php
                                $LeaveEntitlement = $users->entitled;
                                $Total_working_days = $users->leaves()->sum('days_hr_approved');
                                $Balance = $LeaveEntitlement - $Total_working_days;
                                $Alert = 'Staff Leave for the year is complete!';
                                $Alert1 = 'Staff has taken more leave than entitled!';
                                ?>

                                <h5><i class="fa fa-calculator fa-2x" style="padding-right: 10px"></i> Leave Entitlement: <a
                                        href="#" class="btn btn-info btn-sm" style="margin-right: 10px"> <?php echo $LeaveEntitlement; ?> </a>
                                    Days gone on leave: <a href="#" class="btn btn-success btn-sm"
                                        style="margin-right: 10px"> <?php echo $Total_working_days; ?></a> Balance: <a href="#" class="btn btn-warning btn-sm"> <?php echo $Balance; ?> </a>

                                    <b style="color: red; padding-left: 20px">
                                        <?php if ($Total_working_days > $LeaveEntitlement) {
                                        echo $Alert1;
                                        } elseif ($Total_working_days == $LeaveEntitlement) {
                                        echo $Alert;
                                        } else {
                                        echo '';
                                        } ?>
                                    </b>

                                </h5>

                            </div>
                        </div>






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

                                </tr>
                            </thead>


                            <tbody>
                                <?php $rows = 0; ?>
                                @foreach ($users->leaves() as $request)
                                    <tr>
                                        <td class="text-center" style="width: 1%">{{ $rows = $rows + 1 }}</td>
                                        <td class="text-center" style="width: 20%"><a
                                                href="/supervisor/{{ $request->id }}/edit">
                                                {{ $request->users->name }}</a>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small>
                                        </td>
                                        <td class="text-center"> {{ $request->working_days_no }}</td>
                                        <td class="text-center" style="width: 20%"> {{ $request->reason }}</td>


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
