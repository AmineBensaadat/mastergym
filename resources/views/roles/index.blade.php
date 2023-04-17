@extends('layouts.master')
@section('title') @lang('translation.users') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') @lang('translation.pages') : @endslot
@slot('title') @lang('translation.users') @endslot
@endcomponent

<!--datatable css-->
<link href="{{ URL::asset('assets/css/dataTables.bootstrap5.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="{{ URL::asset('assets/css/responsive.bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />


<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="pull-left">
    <h2>Role Management</h2>
    </div>
    <div class="pull-right">
    @can('role-create')
    {{-- <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a> --}}
    @endcan
    </div>
    </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
    <tr>
    <th>No</th>
    <th>Name</th>
    <th width="280px">Action</th>
    </tr>
    @foreach ($roles as $key => $role)
    <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $role->name }}</td>
    <td>
    {{-- <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a> --}}
    @can('role-edit')
    {{-- <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a> --}}
    @endcan
    @can('role-delete')
    {{-- {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!} --}}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endcan
    </td>
    </tr>
    @endforeach
    </table>
    {!! $roles->render() !!}
    <p class="text-center text-primary"><small>Tutorial by rscoder.com</small></p>


@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}" crossorigin="anonymous"></script>

<script src="{{ URL::asset('/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/buttons.html5.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script>

    $(document).ready(function(){
        fill_datatable();
        function fill_datatable(global_filter = '' ,filter_name = '', filter_email = '')
            {
                var dataTable = $('#users_dt').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "scrollX": true,
                    "searching" : false,
                    "ajax" : {
                    url:"../users/getAllUsers",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        global_filter:global_filter,
                        filter_name:filter_name,
                        filter_email:filter_email
                    }
                    }
                });
            }

            $( ".search" ).keyup(function() {
                var global_filter = $('.search').val();
                $('#users_dt').DataTable().destroy();
                fill_datatable(global_filter);
            });





    });
</script>

@if (session('stored'))
    <script src="{{ URL::asset('/assets/js/custom/coustom_toastify.js') }}"></script>
    {{ session(['stored' => false]) }}
@endif

@endsection

