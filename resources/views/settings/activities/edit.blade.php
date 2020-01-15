@extends('layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title">Edit Activity</h2>
                </div>
                <form action="{{ url('settings/activities') }}" method="POST">
                    <div class="box-body">
                            @csrf
                            <input type="hidden" name="id" value="{{ $activity->id }}">
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