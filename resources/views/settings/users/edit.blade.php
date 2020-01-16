@extends('layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title">Edit Staff</h2>
                </div>
                <form action="{{ url('settings/users') }}" method="POST">
                    <div class="box-body">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            @include('settings.users.partials.form')
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ URL::to('settings/users') }}" class="btn btn-default">Back</a>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection