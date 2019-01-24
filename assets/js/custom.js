// To make Pace works on Ajax calls
$(document).ajaxStart(function() { Pace.restart(); });
$(document).load(function(){
	window.requestFullscreen();
});
$(document).ready(function(){
	// $(".alert").fadeOut(7000);	
});
//DataTable
$(".datatable").DataTable({
	scrollX : true,
});
(function () {
  if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
	var body = document.getElementsByTagName('body')[0];
	body.className = body.className + ' sidebar-collapse';
  }
})();
$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      // increaseArea: '20%'
    });
});
moment.locale('id');
$('.moment').each(function(i, obj) {
    var dt = $(this).html();
	$(this).html(moment(dt).startOf('second').fromNow());
});
$('.moment-detail').each(function(i, obj) {
    var dt = $(this).html();
	$(this).html(moment(dt).format('LLLL'));
});
// Click handler can be added latter, after jQuery is loaded...
$('.sidebar-toggle').click(function(event) {
  event.preventDefault();
  if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
	sessionStorage.setItem('sidebar-toggle-collapsed', '');
  } else {
	sessionStorage.setItem('sidebar-toggle-collapsed', '1');
  }
});
//Date picker
$('.dtp').datepicker({
	autoclose: true,
	format: 'yyyy-mm-dd',
});
//Select 2
$('.select2').select2();
$('.dtpyear').datepicker({
    autoclose: true,
    format: " yyyy",
    viewMode: "years", 
    minViewMode: "years",
    // startDate: '2014',
    // endDate: new Date(),
});
//Inputmask
$(".currency").inputmask({
'alias': 'numeric', 'groupSeparator': '.', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': '0',"removeMaskOnSubmit":true, "rightAlign": false});
$('.dtrnp').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

$('.dtrnp').on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
});

$('.dtrnp').on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
});

$('button[name=btnsave]').click(function(){
	$('#form-modal').submit();
});

function add_data(label,url){
	$.ajax({
		type	: "POST", 
		url		: url,
		data	: {
			label:label
		},
		timeout	: 10000,
		success	: function(data){
			$('.modal-body').html(data);
			$('.modal-footer').show();
			$('#modal').modal('show');
		},
		failed	: function(data){
			$('.modal-body').html("Gagal mendapatkan data, coba kembali...");
			$('.modal-footer').hide();
			$('#modal').modal('show');
		}
	});
}

function view_data(label,url,id){
	$.ajax({
		type	: "POST", 
		url		: url,
		data	: {
			label:label,
			id:id
		},
		timeout	: 10000,
		success	: function(data){
			$('.modal-body').html(data);
			$('.modal-footer').hide();
			$('#modal').modal('show');
		},
		failed	: function(data){
			$('.modal-body').html("Gagal mendapatkan data, coba kembali...");
			$('.modal-footer').hide();
			$('#modal').modal('show');
		}
	});
}

function edit_data(label,url,id){
	$.ajax({
		type	: "POST", 
		url		: url,
		data	: {
			label:label,
			id:id
		},
		timeout	: 10000,
		success	: function(data){
			$('.modal-body').html(data);
			$('.modal-footer').show();
			$('#modal').modal('show');
		},
		failed	: function(data){
			$('.modal-body').html("Gagal mendapatkan data, coba kembali...");
			$('.modal-footer').hide();
			$('#modal').modal('show');
		}
	});
}

function delete_data(label,url,id){
	var conf = confirm("Apakah yakin akan dihapus ?");
	if(conf){
		$.ajax({
			type	: "POST", 
			url		: url,
			data	: {
				label:label,
				id:id
			},
			timeout	: 10000,
			success	: function(data){
				location.reload();
			},
			failed	: function(data){
				$('.modal-body').html("Gagal menghapus data, coba kembali...");
				$('.modal-footer').hide();
				$('#modal').modal('show');
			}
		});
	}
}

$(".btnplusone").click(function(e){
	var qty = $(this).closest('.input-group').find('input.inqty').val();
	$(this).closest('.input-group').find('input.inqty').val(parseInt(qty)+1);;
	
});
$(".btnminusone").click(function(){
	var qty = $(this).closest('.input-group').find('input.inqty').val();
	if(qty > 1){
		$(this).closest('.input-group').find('input.inqty').val(parseInt(qty)-1);;
	}
});

function addtocart(id){
	var url = $("#urlcart").val();
	var qty = $("input[name=qty-"+id+"]").val();
	var ket = $("textarea[name=ket-"+id+"]").val();
	var nama = $("input[name=nama-"+id+"]").val();
	var harga = $("input[name=harga-"+id+"]").val();
	
	$.ajax({
			type	: "POST", 
			url		: url,
			data	: {
				id:id,
				qty:qty,
				harga:harga,
				nama:nama,
				ket:ket
			},
			timeout	: 10000,
			success	: function(data){
				load_cart();
			},
			failed	: function(data){
				alert('gagal');
			}
		});
}

function load_cart(){
	var url = $("#urlloadcart").val();
	$.ajax({
		type	: "POST", 
		url		: url,
		timeout	: 10000,
		success	: function(data){
			$("#load_cart").html(data);
			$('.inqty').val(1);
			$('.ket').val("");
		},
		failed	: function(data){
			alert('gagal load cart');
		}
	});
}

function del_cart(url){
	$.ajax({
		type	: "POST", 
		url		: url,
		timeout	: 10000,
		success	: function(data){
			load_cart();
		},
		failed	: function(data){
			alert('gagal hapus');
		}
	});
}

function clearcart(url){
	$.ajax({
		type	: "POST", 
		url		: url,
		timeout	: 10000,
		success	: function(data){
			load_cart();
		},
		failed	: function(data){
			alert('gagal hapus');
		}
	});
}