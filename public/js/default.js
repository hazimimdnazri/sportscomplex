$('#modal-default').on('hidden.bs.modal', function(e) {
	$(this).data('bs.modal', null);
    $('.modal-content').empty();
});

$('.confirm').on('click',function(d){
	console.log(1);
	d.preventDefault();
	var href = $(this).attr('value');
	swal({
	  	title: "ARE YOU SURE?",
	  	text: "You will not be able to recover this data!", 
		type: "warning",
	  	buttons: {
		    cancel: true,
		    confirm: true,
		},
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "CONFIRM",
        cancelButtonText: "CANCEL",
        closeOnConfirm: false,
        closeOnCancel: false
	}).then((willDelete) => {
	    if (willDelete) {
	        window.location.href = href;
	    } else {
	        swal("Successful! Cancelled", {
	          icon: "success",
	        });
	    }
    });
});