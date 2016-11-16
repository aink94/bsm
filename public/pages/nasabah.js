var form = '' +
    '<form class="form-horizontal">'+
    '<div class="modal-body">'+
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Nis</label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="nis" class="form-control">'+
    '</div>'+
    '</div>'+
    //end-form-group
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Nama</label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="nama" class="form-control">'+
    '</div>'+
    '</div>'+
    //end-form-group
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Status Kartu</label>'+
    '<div class="col-sm-9">' +
    '<select name="status_kartu" class="form-control">'+
	'<option value="">Pilih Status Kartu</option>'+
	'<option value="GOLD">GOLD</option>'+
	'<option value="SILVER">SILVER</option>'+    
    '</select>'+
    '</div>'+
    '</div>'+
    //end-form-group
    '<div class="modal-footer">'+
    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
    '<button type="button" class="btn btn-default" id="btnSimpan">Simpan</button>'+
    '</div>'+
    '</form>';
var formhapus = '' +
    '<form class="form-horizontal">'+
    '<div class="modal-footer">'+
    '<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>'+
    '<button type="button" class="btn btn-default" id="btnSimpan">Ya</button>'+
    '</div>'+
    '</form>';
var table = $("#table").DataTable({
	"processing": true,
    //"serverSide": true,
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "select": {
        style: 'single'
    },
    "ajax": {
        "url" : "/nasabah/data-nasabah",
        "dataSrc" : "data"
    },
    "columns" : [
        {"data": "nis"},
        {"data": "nama"},
        {"data": "kartu"}
    ]
});

$(function(){
	//define button
    $('#hapus').attr("disabled", 'disabled')
    $('#ganti').attr("disabled", 'disabled')

	table.on('select', function ( e, dt, type, indexes ) {
		$('#ganti').removeAttr("disabled");
		$('#hapus').removeAttr("disabled");
		$('#hapus').on('click', function(){
	 		$('body').append(modal);
	 		if($('form').length == 0) {
		        $('.modal-content').append(formhapus);
		        $('.modal-dialog').addClass('modal-sm');
		    }
	 		$('.modal-title').text("Yakin akan dihapus ?");
	 		$('#modal').modal({keyboard: false, backdrop: 'static'});

	 		//AJAX
	 		$(".modal").on("click", "#btnSimpan", function(){
	 			$.ajax({
	 				type    : 'POST',
		            url     : window.location+"/hapus",
		            dataType: 'json',
		            data: {
		                '_token'    : $("input[name='_token']").val(),
		                'id'        : $("input[name='id']").val(),
		                'nama'      : $('input[name="nama"]').val(),
		                'keterangan': $('input[name="keterangan"]').val(),
		            }
	 			}).done(function(){
	 				table.ajax.reload();
	 			});
	 		});

	 		$("#modal").on('hidden.bs.modal', function(e){
	            $('.modal').remove();
	        });
	 	}); 
		$('#ganti').on('click', function(){
	 		$('body').append(modal);
	 		if($('form').length == 0) {
		        $('.modal-content').append(form);
		    }
	 		$('.modal-title').text("Ganti Kartu");
	 		$('#modal').modal({keyboard: false, backdrop: 'static'});

	 		//AJAX
	 		$(".modal").on("click", "#btnSimpan", function(){
	 			$.ajax({
	 				type    : 'POST',
		            url     : window.location+"/hapus",
		            dataType: 'json',
		            data: {
		                '_token'    : $("input[name='_token']").val(),
		                'id'        : $("input[name='id']").val(),
		                'nama'      : $('input[name="nama"]').val(),
		                'keterangan': $('input[name="keterangan"]').val(),
		            },
		            success: function(){
		                table.ajax.reload();
		            }
	 			});
	 		});

	 		$("#modal").on('hidden.bs.modal', function(e){
	            $('.modal').remove();
	        });
	 	}); 
	 //    var rowData = table.rows( indexes ).data().toArray();
	 //    //console.log(rowData);
	}).on( 'deselect', function ( e, dt, type, indexes ) {
		$('#ganti').attr("disabled", 'disabled');
		$('#hapus').attr("disabled", 'disabled');
	});

	$('#tambah').on('click', function(event){
		RFID.Request({
			context : {
				event   : event,
				context : 'rfid',
				title   : "Tambah"
			},
			title   : "Tambah",
		    async   : true,
		    url     : '/asd',
		    waktu   : 5000,
		    berhasil: function (data) {
		        console.log(data);
		    },
		    selalu  : function(event){
		    	console.log("SELALU ========+++++++++++++++++++++");
		    	console.log(event);
		    }
		});
 	});

	$('#ubah').on('click', function(event){
		RFID.Request({
			context : {
				event   : event,
				context : 'rfid',
				title   : "Ubah"
			},
			title   : "Ubah",
		    async   : false,
		    global  : true,
		    berhasil: function (data) {
		    	
		    },
		    selalu  : function(jqXHR, textStatus, errorThrown){
		    	console.log("SELALU ========+++++++++++++++++++++");
		    	console.log(jqXHR);
		    	console.log(textStatus);
		    	console.log(errorThrown);
		    }
		});
 	});

 	$("#modal").on('hidden.bs.modal', function(e){
        $('.modal').remove();
    });
});
