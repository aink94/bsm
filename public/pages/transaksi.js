var form = '' +
    '<form class="form-horizontal">'+
    '<div class="modal-body">'+
    //form-group
    '<div class="form-group">'+
    '<label class="col-sm-3 control-label">Jumlah Uang</label>'+
    '<div class="col-sm-9">' +
    '<input type="text" name="jumlah" class="form-control">'+
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
	"processing"  : true,
    //"serverSide": true,
    "paging"      : true,
    "lengthChange": false,
    "searching"   : true,
    "ordering"    : false,
    "info"        : false,
    "autoWidth": false,
    "select"      : {
        style: 'single'
    },
    "ajax"        : {
    	"context" : {
    		"context" : "table"
    	},
        "url"     : "/transaksi/get-data-per-day",
        "dataSrc" : "data"
    },
    "columns"     : [
        {"data": "nasabah"},
        {"data": "tanggal"},
        {"data": "jumlah"},
        {"data": "jt"}
    ]
});

$(function(){
	table.on('select', function ( e, dt, type, indexes ) {

	 //    var rowData = table.rows( indexes ).data().toArray();
	 //    //console.log(rowData);
	 	$('#ubah').on('click', function(){
	 		$('body').append(modal);
	 		if($('form').length == 0) {
		        $('.modal-content').append(form);
		    }
	 		$('.modal-title').text("Ubah transaksi");
	 		$('#modal').modal({keyboard: false, backdrop: 'static'});

	 		//AJAX
	 		$(".modal").on("click", "#btnSimpan", function(){
	 			$.ajax({
	 				type    : 'POST',
		            url     : window.location+"/ubah",
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
	 	$('#hapus').on('click', function(){
	 		$('body').append(modal);
	 		if($('form').length == 0) {
		        $('.modal-content').append(formhapus);
		    }
	 		$('.modal-title').text("Apakah yakin Akan dihapus ?");
	 		$('.modal-dialog').addClass('modal-sm');
	 		$('#modal').modal({keyboard: false, backdrop: 'static'});

	 		$(".modal").on("click", "#btnSimpan", function(){
	 			console.log("clicked btn-simpan");
	 		});

	 		$("#modal").on('hidden.bs.modal', function(e){
	            $('.modal').remove();
	        });
	 	});
	})
	.on( 'deselect', function ( e, dt, type, indexes ) {
		$('#ubah').attr("disabled", 'disabled')
	    $('#hapus').attr("disabled", 'disabled')
	    $('#tambah').removeAttr("disabled")
	});

	$('#tarik').on('click', function(event){
 		RFID.Request({
			context : {
				event   : event,
				context : 'rfid',
				title   : "Simpan"
			},
			title   : "Simpan",
		    async   : true,
		    //url     : '/asd',
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

	$('#simpan').on('click', function(event){
 		RFID.Request({
			context : {
				event   : event,
				context : 'rfid',
				title   : "Simpan"
			},
			title   : "Simpan",
		    async   : true,
		    //url     : '/asd',
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

});