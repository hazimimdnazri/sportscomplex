<p>Please fill in all the required fields, denoted with <span class="text-red">*</span>.</p>
<div class="row">
    <div class="col-lg-12">
        <div id="errors" style="display:none" class="alert alert-danger alert-dismissable"></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Membership ID </label>
            {{-- <input name="id" type="text" class="form-control" value="{{ $customer->id }}" placeholder="Member ID (if available)" readonly> --}}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
            <input type="text" class="form-control" id="name" value="{{ $customer->name }}" name="name" placeholder="Applicant name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">I.C Number <span class="text-red">*</span></label>
            <input type="text" class="form-control" id="ic" value="{{ $customer->ic }}" name="ic" placeholder="Applicant MyKad / MyKid">
        </div>
        <div class="form-group">
            <label>Address <span class="text-red">*</span></label>
            <textarea class="form-control" id="address" name="address" rows="2" placeholder="Applicant address">{{ $customer->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">City <span class="text-red">*</span></label>
            <input type="text" class="form-control" id="city" value="{{ $customer->city }}" name="city" placeholder="Applicant city">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Membership Type <span class="text-red">*</span></label>
            <select onChange="member(this.value)" class="form-control" name="membership">
                @foreach($memberships as $m)
                    <option value="{{ $m->id }}" <?= $customer->membership == $m->id ? 'selected' : '' ?>>{{ $m->membership }}</option>
                @endforeach
            </select>
            <small><span style="color:gold">Gold</span> = 20% discounted price</small><br>
            <small><span style="color:silver">Silver</span> = 15% discounted price</small><br>
            <small><span style="color:brown">Bronze</span> = 10% discounted price</small><br>
            <small><span style="color:blue">EduCity Students</span> = 20% discounted price</small>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" placeholder="Applicant email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone <span class="text-red">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" placeholder="Applicant phone number">
        </div>
        <div class="form-group">
            <label>Date of Birth <span class="text-red">*</span></label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="dob" value="{{ date('d-m-Y', strtotime($customer->dob)) }}" class="form-control pull-right" id="datepicker">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Zipcode <span class="text-red">*</span></label>
            <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $customer->zipcode }}" placeholder="Applicant zipcode">
        </div>
        <div class="form-group">
            <label>State <span class="text-red">*</span></label>
            <select name="state" class="select2 form-control" id="state" style="width: 100%;">
                <option value="" selected>-- State --</option>
                <option value="1" <?= $customer->state == 1 ? 'selected' : '' ?> >Johor</option>
                <option value="2" <?= $customer->state == 2 ? 'selected' : '' ?> >Kedah</option>
                <option value="3" <?= $customer->state == 3 ? 'selected' : '' ?> >Kelantan</option>
                <option value="4" <?= $customer->state == 4 ? 'selected' : '' ?> >Melaka</option>
                <option value="5" <?= $customer->state == 5 ? 'selected' : '' ?> >Negeri Sembilan</option>
                <option value="6" <?= $customer->state == 6 ? 'selected' : '' ?> >Pahang</option>
                <option value="7" <?= $customer->state == 7 ? 'selected' : '' ?> >Perak</option>
                <option value="8" <?= $customer->state == 8 ? 'selected' : '' ?> >Perlis</option>
                <option value="9" <?= $customer->state == 9 ? 'selected' : '' ?> >Pulau Pinang</option>
                <option value="10" <?= $customer->state == 10 ? 'selected' : '' ?> >Sabah</option>
                <option value="11" <?= $customer->state == 11 ? 'selected' : '' ?> >Sarawak</option>
                <option value="12" <?= $customer->state == 12 ? 'selected' : '' ?> >Selangor</option>
                <option value="13" <?= $customer->state == 13 ? 'selected' : '' ?> >Terengganu</option>
                <option value="14" <?= $customer->state == 14 ? 'selected' : '' ?> >W.P. Kuala Lumpur</option>
                <option value="15" <?= $customer->state == 15 ? 'selected' : '' ?> >W.P. Labuan</option>
                <option value="16" <?= $customer->state == 16 ? 'selected' : '' ?> >W.P. Putrajaya</option>
            </select>
        </div>
        {{-- @if(!empty($customer->id)) --}}
            <div class="form-group">
                <label>Payment Cycle <span class="text-red">*</span></label>
                <select name="cycle" class="form-control">
                    <option value="">-- Cycle --</option>
                    <option id="monthly" value="1" <?= $customer->cycle == 1 ? 'selected' : '' ?> >Monthly</option>
                    <option id="anually" value="2" <?= $customer->cycle == 2 ? 'selected' : '' ?>>Anually</option>
                </select>
            </div>
        {{-- @endif --}}
    </div>
</div>

@section('postscript')
<script>
    $(() => {
        $('.select2').select2()

        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            endDate: '-1d',
            startView: 3,
            defaultDate: '1993-02-14'
        })

        $.ajax({
            type:"POST",
            url: "{{ url('ajax/membershipprice') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "membership" : "{{ $customer->membership }}"
            }
        }).done(function(response){
            document.getElementById("monthly").innerHTML = "Monthly (RM"+response.monthly+")"
            document.getElementById("anually").innerHTML = "Anually (RM"+response.anually+")";
        });
    })

    member = (value) => {
        $.ajax({
            type:"POST",
            url: "{{ url('ajax/membershipprice') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "membership" : value
            }
        }).done(function(response){
            document.getElementById("monthly").innerHTML = "Monthly (RM"+response.monthly+")"
            document.getElementById("anually").innerHTML = "Anually (RM"+response.anually+")";
        });
    }
</script>
@endsection