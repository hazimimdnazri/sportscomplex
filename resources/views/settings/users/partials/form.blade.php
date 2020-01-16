<div class="form-group">
    <label>Name <span class="text-red">*</span></label>
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $user->name }}" required>
</div>
<div class="form-group">
    <label>E-Mail <span class="text-red">*</span></label>
    <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-mail" required readonly onfocus="this.removeAttribute('readonly');">
    {{-- <small>Activation email will be sent. E-mail will be used for login.</small> --}}
</div>
<div class="form-group">
    <label>Role <span class="text-red">*</span></label>
    <select class="form-control" name="role" required>
        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Staff</option>
        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
    </select>
</div>
<div class="form-group">
    <label>Password <span class="text-red">*</span></label>
    <input type="password" class="form-control" name="password" placeholder="Password">
    {{-- <small>Defualt password will be 123456. Please change when the user login for the first time.</small> --}}
</div>