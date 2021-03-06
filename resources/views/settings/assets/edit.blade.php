@extends('layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title">Edit Asset</h2>
                </div>
                <form action="{{ url('settings/assets') }}" method="POST">
                    <div class="box-body">
                            @csrf
                            <input type="hidden" name="id" value="{{ $asset->id }}">
                            @include('settings.assets.partials.form')
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ URL::to('settings/assets') }}" class="btn btn-default">Back</a>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection