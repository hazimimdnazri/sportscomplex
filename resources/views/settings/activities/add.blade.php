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
                    <h2 class="box-title">Add Activity</h2>
                </div>
                <form action="{{ url('settings/activities') }}" method="POST">
                    <div class="box-body">
                            @csrf
                            @include('settings.activities.partials.form')
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ URL::to('settings/activities') }}" class="btn btn-default">Back</a>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection