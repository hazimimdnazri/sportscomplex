@extends('layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title">Edit Member</h2>
                </div>
               
                <form id="application_form" action="{{ url('settings/customers') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $customer->id }}">
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