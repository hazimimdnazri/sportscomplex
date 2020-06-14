<div class="modal fade" id="usersModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/settings/users') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $id ? 'Edit User' : 'New User' }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name <span class="text-red">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="event" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-Mail <span class="text-red">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="event" placeholder="E-mail">
                    </div>
                    @if(!($id))
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password <span class="text-red">*</span></label>
                        <input type="password" class="form-control" name="password" value="123456" readOnly>
                        <small>Defualt password will be 123456. Please change when the user login for the first time.</small>
                    </div>
                    @endif
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>