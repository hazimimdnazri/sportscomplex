@extends('layouts.main')

@section('content')
{{-- <section class="content-header">
    <h1>
        Assets
        <small>Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Settings</li>
        <li class="active">Add Assets</li>
    </ol>
</section> --}}

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Edit Asset Category</h2>
                </div> 
                <form action="{{ url('settings/categories') }}" method="POST">
                    <div class="box-body">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        @include('settings.categories.partials.form')
                    </div>
                    <div class="box-footer text-right">
                        <a href="{{ URL::to('settings/categories') }}" class="btn btn-default">Back</a>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection