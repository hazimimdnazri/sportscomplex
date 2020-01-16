@extends('layouts.main')

@section('content')
{{-- <section class="content-header">
    <h1>
        activities
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Add activities</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Add Member</h2>
                </div>
                <form id="application_form" action="{{ url('settings/customers') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        @include('settings.customers.partials.form')
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ URL::to('settings/customers') }}" class="btn btn-default">Back</a>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection