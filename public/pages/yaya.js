var rfidform = ''+
	'<form>'+
	'<div class="modal-body icon-rfid">'+
	'<center>'+
	'<img src="assets/img/scan-rfid.gif">'+
	'</center>'+
	'</div>'+
	'</form>';
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
        {"data": "id"},
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
		$('#ganti').on('click', function(){
	 		$('body').append(modal);
	 		if($('form').length == 0) {
		        $('.modal-content').append(rfidform);
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

	$('#tambah').on('click', function(){
		var locale = RFID.Request({
			title   : "Tambah",
		    async   : false,
		    url     : "http://bsm.app/sss",
		    //waktu   : 5000,
		    berhasil: function (data) {
		        console.log(data);
		        // ...or 
		        // use the 'data' inside of this callback if you are concerned about async failures
		    }
		});
 	});

	$('#ubah').on('click', function(){
		var locale = RFID.Request({
			title   : "Ubah",
		    async   : true,
		    berhasil: function (data) {
		        console.log(data);
		        // ...or 
		        // use the 'data' inside of this callback if you are concerned about async failures
		    }
		});
 	});
});


//buat object
var RFID = (function(){
	//ctor
	function self(){}

	//ajax request
	self.Request = function (params){
		var xhr = $.ajax({
			dataType 	: params.datatype || "json",
			type 		: params.verb || "GET",
			contentType : params.contentType || "application/json",
			data 		: params.data || {},
			async    	: params.async || true,
			processData : params.processData || true,
            url         : params.url || 'http://bsm.app/rfid',
            global 		: params.global || false,
			timeout 	: 5000,
			beforeSend	: function(xhr, obj){
				$('body').append(modal);
		 		if($('form').length == 0) {
			        $('.modal-content').append(rfidform);
			    }
		 		$('.modal-title').text(params.title+" Nasabah");
		 		$('#modal').modal({keyboard: false, backdrop: 'static'});
			}
		})
		.done(function(data, textStatus, jqXHR){
			$('form').remove();
			if($('form').length == 0) {
		        $('.modal-content').append(form);
		    }
		    params.berhasil(data);
		    console.log("Sucsess");
		    console.log(jqXHR);
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			console.log("Error Ajax");
			console.log(jqXHR);
			$("#modal").modal("hiden");
			switch (jqXHR.statusText){
				//timeout
				case "timeout":
					$("#modal").modal("hide");
					$.gritter.add({
		                title      : "timeout",
		                text       : "Terlalu Lama",
		                image      : 'assets/img/error.png',
		                sticky     : false,
		                time       : '5000',
		                class_name : 'my-sticky-class'
		            });
		        break;
		        //modal ditutup
		        case "abort":
		        	$.gritter.add({
		                title      : "abort",
		                text       : "Request dibatalkan",
		                image      : 'assets/img/error.png',
		                sticky     : false,
		                time       : '5000',
		                class_name : 'my-sticky-class'
		            });
		        break;
		        //handling laravel
		        case "Bad Request" :
		        	$.gritter.add({
		                title      : jqXHR.responseJSON.errors,
		                text       : jqXHR.responseJSON.message,
		                image      : 'assets/img/error.png',
		                sticky     : false,
		                time       : '5000',
		                class_name : 'my-sticky-class'
		            });
				break;
				//data kosong
		        case "OK" :
		        	$.gritter.add({
		                title      : "Data Kosong",
		                text       : "Harap Scan Ulang",
		                image      : 'assets/img/error.png',
		                sticky     : false,
		                time       : '5000',
		                class_name : 'my-sticky-class'
		            });
				break;
			}
		})
		.always(function(jqXHR, textStatus, errorThrown){//data|jqXHR, textStatus, jqXHR|errorThrown
			$("#modal").on('hidden.bs.modal', function(e){
	            $('.modal').remove();
	        });
	        console.log("Complete");
		    console.log(jqXHR);
		});

		//modal ditutup
		$("#modal").on('hidden.bs.modal', function(e){
	        //$('.modal').remove();
	        xhr.abort();
	    });
	};

	//Return Object
	return self;
})($);