@extends('layouts.app')

@section('css')
<!-- <link rel="stylesheet" href="{{URL::asset('plugins/select2.min.css')}}"> -->
<link href="{{asset('css/select2-bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style>
    .required {
        font-size: 12px;
        color: red;
    }
</style>
@stop

@section('content')
<section class="forms">
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Tes Print</h4>
                        <a href="#"></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                    	<label>Barcode *</label>
                                        <div class="search-box input-group">
                                        	
                                            <!-- <button type="button" class="btn btn-secondary btn-lg"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Cari produk" class="form-control" /> -->
                                            <select name="" id="barang" class="form-control input-sm select2" style="width: 100%">
                                                        <option selected="" value="">Pilih Barang</option>
                                                    </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Barcode</th>
                                                        <th>Qty</th>
                                                        <th><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="row">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                             
                                <!-- <div class="form-group">
                                    <input type="submit" value="submit" class="btn btn-primary" id="submit-button">
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#print-barcode">
  Print Barcode
</button>

  
</section>
@endsection

@section('js')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- <script type="text/javascript" src="{{URL::asset('/plugins/select2.full.min.js')}}"></script> -->
<script type="text/javascript" src="{{URL::asset('/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/vendor/keyboard/js/jquery.keyboard.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('/vendor/jquery/jquery.min.js')}}"></script> -->
<script type="text/javascript" src="{{URL::asset('/vendor/jquery/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/vendor/jquery/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/vendor/jquery/jquery.timepicker.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
    $(".select2").select2();

    var barang = 0;
    var barang_tambahan = [];
    var countRow = 0;

     //append row gondola
     $('#barang').on('change',function(){
			countRow = countRow + 1;
			
			var id,code,cek;
			var trHTML = '';

			id          = $(this).val();
			code        = $(this).find("option:selected").data('barcode');
            price       = $(this).find("option:selected").data('price');
            promo_price = $(this).find("option:selected").data('promo-price');
            name        = $(this).find("option:selected").data('name');

			if (id != '') {
				var cek = 0;
				
				if( cek == 0){
				
					barang_tambahan.push(id+'r'+countRow);

					trHTML += '<tr id="'+id+'r'+countRow+'" data-price="'+ price +'" data-barcode="'+ code +'" data-promo-price="'+ promo_price +'">';

			            trHTML += '<td>'+ name +'</td>';

			            trHTML += '<td>'+ code +'</td>';

			            trHTML += '<td> </td>';

			            trHTML += '<td>';

	                        trHTML += '<button type="button" name="button" value=" '+id+'r'+countRow+' " class="btn btn-danger btn-sm" onclick="deleteRowBarang(\''+id+'r'+countRow+'\')"><span class="fa fa-trash"></span></button>'
	                    trHTML += '</td>';

			        trHTML += '</tr>';

			        $('#row').append(trHTML);
			        $('#barang').val('').trigger('change');
				}else{
					$('#barang').val('').trigger('change');
				}
			}

		});

        $.ajax({
                url: "<?= url('get_produk') ?>",
                method: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#barang').children('option:not(:first)').remove().end();

                    barang = [];
                    $.each(data,function(index,fakturObj){
                        $('#barang').append('<option data-price="'+fakturObj.price+'" data-promo-price="'+fakturObj.promo_price+'" data-barcode="'+fakturObj.barcode+'" data-name="'+fakturObj.name+'" value="'+fakturObj.code+'"> '+fakturObj.name+' - '+fakturObj.barcode+' - '+fakturObj.code+' </option>')
                    });
                }
        });
   
});


    //hapus row tabel
    function deleteRowBarang(id){

        var removeItem = id;

        if (confirm('Apakah anda yakin menghapus data ?')) {
                
            $('#row tr#'+id).remove();
            $(this).tooltip('hide');
        }
    }

//  $("ul#product").siblings('a').attr('aria-expanded','true');
//     $("ul#product").addClass("show");
//     $("ul#product #printBarcode-menu").addClass("active");


//     var lims_productcodeSearch = $('#lims_productcodeSearch');

//     lims_productcodeSearch.autocomplete({
//     source: function(request, response) {
//         var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
//         response($.grep(lims_product_code, function(item) {
//             return matcher.test(item);
//         }));
//     },
//     select: function(event, ui) {
//         var data = ui.item.value;
//         $.ajax({
//             type: 'GET',
//             url: 'cari_produk',
//             data: {
//                 data: data
//             },
//             success: function(data) {
//                 var flag = 1;
//                 $(".product-code").each(function() {
//                     if ($(this).text() == data[1]) {
//                         alert('duplicate input is not allowed!')
//                         flag = 0;
//                     }
//                 });
//                 $("input[name='product_code_name']").val('');
//                 if(flag){
//                     var newRow = $('<tr data-imagedata="'+data[4]+'" data-price="'+data[3]+'">');
//                     var cols = '';
//                     cols += '<td>' + data[0] + '</td>';
//                     cols += '<td class="product-code">' + data[1] + '</td>';
//                     cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" /></td>';
//                     cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">Delete</button></td>';

//                     newRow.append(cols);
//                     $("table.order-list tbody").append(newRow);
//                 }
//             }
//         });
//     }
// });

// 	//Delete product
// 	$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
// 	    rowindex = $(this).closest('tr').index();
// 	    $(this).closest("tr").remove();
//     });
    
    

// 	$("#submit-button").on("click", function(event){

//         //tes js barcode
//         //JsBarcode("#barcode", "Hi world!");
        
//         /* SHOFIE */
//         let products = [];
// 		var product_name = [];
// 		var code = [];
// 		var price = [];
// 		var promo_price = [];
// 		var qty = [];
// 		var barcode_image = [];
// 		var rownumber = $('table.order-list tbody tr:last').index();
// 		for(i = 0; i <= rownumber; i++){
//             products.push({
//                 code: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text(),
//                 name: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(1)').text(), 
//                 qty: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val(), 
//                 price: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('price'),
//                 promo_price: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('promo-price'),
//                 barcode_image: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('imagedata')    
//             }); 
// 			product_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(1)').text());
// 			code.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text());
// 			price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('price'));
// 			promo_price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('promo-price'));
// 			qty.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
// 			barcode_image.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('imagedata'));
// 		}
//         var htmltext = '<table class="barcodelist" style="width: 100%" cellpadding="5px" cellspacing="10px">';
        
//         let print_table = `<table style="width: 100%" border="0" cellpadding="0">`;
//         let new_products = [];
//         $.each(products, function(index,value){
//             for(i=0;i<value.qty;i++){
//                 new_products.push({
//                     code: value.code,
//                     name: value.name,
//                     price: value.price,
//                     promo_price: value.promo_price,
//                     barcode_image: value.barcode_image
//                 });
//             }


//         })
//         // console.log(new_products);
//         $.each(new_products,function(index,value){
//                 let padding = (index+1) % 2 == 0 ? '3mm 3mm 0mm 1.5mm':'3mm 1.5mm 0mm 3mm';
//                 if(index % 2 == 0)
//                     print_table +='<tr>';
// 				    print_table +='<td>';
//     				if($('input[name="name"]').is(":checked"))
//     				print_table += '<div style="text-align: center; width: 100%; height:21mm; padding: '+padding+';">';
//     				// 	print_table += '<div style="border-radius: 5px;border: 1px solid #ccc;text-align: center;width: 125px; height: 56px;font-size: 6px;"><span style="#333; font-size: 6px; margin-top: 10px">'+product_name[index].substr(0, 15) + '</span><br>';
//                     print_table += '<img src="data:image/png;base64,'+value.barcode_image+'" alt="barcode" style="width: 25mm; height: 7mm; margin-top: 5px"/><div style="height: 8mm; line-height: 0.75rem;"><strong style="text-align: center; font-size: 9px;">'+value.code+'<br>'+value.name.substr(value.name.length - 5) + ' | Rp.'+value.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); + '</strong></div></div>';
//                     if($('input[name="code"]').is(":checked"))
//     					print_table += '<strong>'+value.code+'</strong><br>';
//     				if($('input[name="promo_price"]').is(":checked"))
//     					print_table += 'price: '+value.promo_price+'<br>';
// 				else if($('input[name="price"]').is(":checked"))
// 					print_table += 'price: '+value.price;
// 				    print_table +='</td>';
//                 if(index % 2 != 0)
//                     print_table +='</tr>';
				
//         })

// 		$.each(qty, function(index){
// 			i = 0;
// 			while(i < qty[index]){
                
// 			    var id = product_name[index];
//                 if(i % 2 == 0)
//                     htmltext +='<tr align="center">';
// 				    htmltext +='<td>';
//     				if($('input[name="name"]').is(":checked"))
//     				htmltext += '<div style="text-align: center;width: 125px;">';
//     				// 	htmltext += '<div style="border-radius: 5px;border: 1px solid #ccc;text-align: center;width: 125px; height: 56px;font-size: 6px;"><span style="#333; font-size: 6px; margin-top: 10px">'+product_name[index].substr(0, 15) + '</span><br>';
//                     htmltext += '<span style="width: 7px"></span><img src="data:image/png;base64,'+barcode_image[index]+'" alt="barcode" style="width: 110px; height: 30px; margin-top: 3px"/><br><strong style="text-align: center; font-size: 11px;">'+code[index]+'<br>'+id.substr(id.length - 5) + ' | Rp.'+price[index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); + '</strong></div>';
//                     if($('input[name="code"]').is(":checked"))
//     					htmltext += '<strong>'+code[index]+'</strong><br>';
//     				if($('input[name="promo_price"]').is(":checked"))
//     					htmltext += 'price: '+promo_price[index]+'<br>';
// 				else if($('input[name="price"]').is(":checked"))
// 					htmltext += 'price: '+price[index];
// 				    htmltext +='</td>';
//                 if(i % 2 != 0)
//                     htmltext +='</tr>';
// 				i++;
// 			}
// 		});
//         htmltext += '</table">';
// 		$('#label-content').html(htmltext);
// 		// $('#print-wrapper').shtml(print_table);
// 		$('#print-wrapper').html(print_table);
// 		$('#print-barcode').modal('show');
// 	});

// 	$("#print-btn").on("click", function(){
        
//             var element = document.getElementById('print-wrapper');
//             var opt = {
//                 filename: 'Print Barcode',
//                 pagebreak: { mode: 'avoid-all'},
//                 image: {type: 'jpeg', quality: 1},
//                 html2canvas: {scale: 2, dpi: 72, letterRendering: true},
//                 jsPDF: {orientation: 'l', unit: 'mm', format: [ 21 , 72]}
//             };
//             html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
//                 window.open(pdf.output('bloburl'), '_blank');
//             });

     
//     });

//     $('#print-barcode').on('hidden.bs.modal',function(e){
//         clear_print_wrapper();
//     })

//     function clear_print_wrapper()
//     {
//         $('#print-wrapper').empty();
//     }

//     function hide_modal_print()
//     {
//         $('#print-wrapper').modal('hide');
//     }

</script>
@stop
