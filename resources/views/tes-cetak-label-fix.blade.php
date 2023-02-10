@extends('layouts.app')

@section('htmlheader_title')
    Barcode Label
@endsection

@section('contentheader_title')
    Barcode Label
@endsection

@section('css')
<link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .required {
        font-size: 12px;
        color: red;
    }

    .d-flex {
        display: flex;
        flex-wrap: wrap;
        margin: 0 auto;
        width: 280px;
    }

    .col {
        flex: 0;
        padding: .5rem;
    }

    .print-label-box {
        width: 10px;
        padding: .25rem .25rem .25rem .5rem;
        display: flex;
        border-radius: .5rem;
        align-items: center;
    }

    .print-label-left {
        flex-grow: 1;
        padding-right: .25rem;
        width: 0%;
        width: calc(100% - 1.5rem);
    }

    .print-label-right {
        width: 1.2rem;
        align-self: center;
    }

    .print-label-box img {
        display: block;
        margin: .25rem auto;
        width: 100%;
        height: 24px;
    }
    .print-label-box p {
        margin: 0;
        padding: 0;
        font-size: .75rem;
        line-height: 1.25;
        display: block;
    }

    .print-label-box p.strong {
        font-weight: 700;
        font-size: .825rem;
        line-height: 1.5;
    }

    .print-label-box .print-logo {
        text-align: center;
        transform: rotate(-90deg);
    }

    .print-label-box .print-logo strong {
        margin-left: -75%;
    }

    .print-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
    }

    @import url('https://fonts.googleapis.com/css2?family=DM+Mono&display=swap');
        .dm-mono {
          font-family: 'DM Mono', monospace;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
         
            <section class="forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">

                                            <div class="col-md-3">
                                                <label>Barang / Barcode</label>
                                               
                                                    
                                                    <!-- <button type="button" class="btn btn-secondary btn-lg"><i class="fa fa-barcode"></i></button> -->
                                                    <!-- <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Cari produk" class="form-control" /> -->
                                                    <select name="" id="barang" class="form-control input-sm select2" style="width: 100%">
                                                        <option selected="" value="">Pilih Barang</option>
                                                       
                                                    </select>
                                                
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
                                                        <!-- @foreach ($lims_product_list as $product)
                                                        <tr
                                                            data-price="{{ $product->price }}"
                                                            data-promo-price="{{ $product->promo_price }}"
                                                            data-barcode="{{ $product->barcode }}"
                                                        >
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->barcode }}</td>
                                                            <td><input type="number" class="form-control qty" value="0" /></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    @endforeach -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <strong>Cetak: </strong>&nbsp;
                                            <strong style="display: none"><input type="checkbox" name="code" checked /> Dengan Code</strong>
                                            <strong><input type="checkbox" name="name" checked /> Nama Produk</strong>&nbsp;
                                            <strong><input type="checkbox" name="price" checked /> Dengan Harga</strong>&nbsp;
                                            <strong hidden><input type="checkbox" name="promo_price"/> Harga Promo</strong>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Submit" class="btn btn-primary" id="submit-button">
                                            <button type="button" class="btn btn-warning" id="print-btn">
                                                Print Barcode
                                            </button>
                                            <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#print-barcode">
                                                Print Barcode
                                            </button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div id="print-barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left" data-backdrop="false">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 id="modal_header" class="modal-title">Title</h5>&nbsp;&nbsp;
                        <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i> Print</button>
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                            <div id="label-content">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="modal fade text-left" id="print-barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <button id="print-btn" type="button" class="btn btn-default btn-sm"><i class="dripicons-print"></i> Print</button>
            </div>
            <div class="modal-body">
                    <div id="label-content">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

            <div id="print-wrapper" style="width: 72mm; height:auto;">
                
            </div>
        </section>
        
        </div>
    </div>
</div>



@stop
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

			            trHTML += '<td> <input type="text" maxlength="11" value="0" class="form-control input-sm qty"> </td>';

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

        $('#kategori').on('change',function(){

            var kategori = $(this).val();

            $.ajax({
                url : "<?= url('get_sub_kategori') ?>/" + kategori,
                method: 'GET',
                success: function (data) {
                    console.log(data);
                    $('#sub_kategori').children('option:not(:first)').remove().end();

                    barang = [];
                    $.each(data,function(index,fakturObj){
                        $('#sub_kategori').append('<option value="'+fakturObj.id+'"> '+fakturObj.name+' </option>')
                    });
                }
            });

        });

        // $('#sub_kategori').on('change',function(){

        //     var kategori = $('#kategori').val();
        //     var sub_kategori = $(this).val();
        //     var gudang = $('#gudang').val();

        //     $.ajax({
        //         url : "<?= url('get_produk') ?>/" + kategori + "/" + sub_kategori + "/" + gudang,
        //         method: 'GET',
        //         success: function (data) {
        //             console.log(data);
        //             $('#barang').children('option:not(:first)').remove().end();

        //             barang = [];
        //             $.each(data,function(index,fakturObj){
        //                 $('#barang').append('<option data-price="'+fakturObj.price+'" data-promo-price="'+fakturObj.promo_price+'" data-barcode="'+fakturObj.barcode+'" data-name="'+fakturObj.name+'" value="'+fakturObj.code+'"> '+fakturObj.name+' - '+fakturObj.barcode+' - '+fakturObj.code+' </option>')
        //             });
        //         }
        //     });

        // });

        $.ajax({
                url : "<?= url('get_produk') ?>",
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


 $("ul#product").siblings('a').attr('aria-expanded','true');
    $("ul#product").addClass("show");
    $("ul#product #printBarcode-menu").addClass("active");
	<?php $productArray = []; ?>
	var lims_product_code = [ @foreach($lims_product_list as $product)
        <?php
            $productArray[] = $product->code . ' (' . $product->name . ')';
        ?>
         @endforeach
            <?php
            echo  '"'.implode('","', $productArray).'"';
            ?> ];

    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
    source: function(request, response) {
        var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(lims_product_code, function(item) {
            return matcher.test(item);
        }));
    },
    select: function(event, ui) {
        var data = ui.item.value;
        $.ajax({
            type: 'GET',
            url: 'cari_produk',
            data: {
                data: data
            },
            success: function(data) {
                var flag = 1;
                $(".product-code").each(function() {
                    if ($(this).text() == data[1]) {
                        alert('duplicate input is not allowed!')
                        flag = 0;
                    }
                });
                $("input[name='product_code_name']").val('');
                if(flag){
                    var newRow = $('<tr data-imagedata="'+data[3]+'" data-price="'+data[2]+'">');
                    var cols = '';
                    cols += '<td>' + data[0] + '</td>';
                    cols += '<td class="product-code">' + data[1] + '</td>';
                    cols += '<td><input type="number" class="form-control qty" name="qty[]" value="1" /></td>';
                    cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">Delete</button></td>';

                    newRow.append(cols);
                    $("table.order-list tbody").append(newRow);
                }
            }
        });
    }
});

	//Delete product
	$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
	    rowindex = $(this).closest('tr').index();
	    $(this).closest("tr").remove();
    });
    
    

	$("#submit-button").on("click", function(event){

        //tes js barcode
        //JsBarcode("#barcode", "Hi world!");
        
        /* SHOFIE */
        let products = [];
		var product_name = [];
		var code = [];
		var price = [];
		var promo_price = [];
		var qty = [];
		var barcode_image = [];
		var rownumber = $('table.order-list tbody tr:last').index();
		for(i = 0; i <= rownumber; i++){
            products.push({
                code: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text(),
                name: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(1)').text(), 
                qty: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val(), 
                price: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('price'),
                promo_price: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('promo-price'),
                barcode_image: $('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('imagedata')    
            }); 
			product_name.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(1)').text());
			code.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('td:nth-child(2)').text());
			price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('price'));
			promo_price.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('promo-price'));
			qty.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').find('.qty').val());
			// barcode_image.push($('table.order-list tbody tr:nth-child(' + (i + 1) + ')').data('imagedata'));
		}

        var htmltext = $('<div class="d-flex"></div>');
        var print_table = $(`<div class="d-flex" style="width:72mm"></div>`);
  
        let new_products = [];
        $.each(products, function(index,value){
            for(i=0;i<value.qty;i++){
                new_products.push({
                    code: value.code,
                    name: value.name,
                    price: value.price,
                    promo_price: value.promo_price,
                    barcode_image: value.barcode_image
                });
            }
        });

        $.each(new_products,function(index,value){
            var price = null;
            var isPrice = $('input[name="price"]').is(":checked");
            var isPromo = $('input[name="promo_price"]').is(":checked");

            if(isPromo)
                price = value.promo_price;
            else if(isPrice)
                price = value.price;

            var container = $('<div class="col" style="padding:2mm"></div>');
            var box = $('<div class="print-label-box" style="width:29mm;height:10mm;padding:1mm 1mm 1mm 2mm"></div>');

            // Left Column
            var left = $('<div class="print-label-left" style="width: calc(100% - 5mm)"></div>');

                if($('input[name="name"]').is(":checked"))
                    left.append('<p class="print-ellipsis dm-mono" style="font-size:1.75mm">'+value.name+'</p>');

                // Image
                var image = $('<img />');
                image.JsBarcode(value.code, {
                    format: "CODE128",
                    displayValue: false,
                    width: 300,
                    height: 90
                });

                left.append(image.attr('style', 'height:4.5mm;margin:.5mm auto 1mm'));

                if($('input[name="code"]').is(":checked"))
                    left.append('<p style="font-size:1.75mm" class="dm-mono">'+value.code+'</p>');

                if (price !== null) {
                    var pricing = $('<div class="d-flex" style="width: auto"></div>');

                    if (isPromo && isPrice)
                        pricing.append('<p style="margin-right:1mm"><del>Rp.'+value.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</del></p>');

                    pricing.append('<p class="strong dm-mono" style="font-size:2mm">Rp.'+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</p>');

                    left.append(pricing);
                }

            // Right Column
            var right = $('<div class="print-label-right"></div>');
            
            right.append('<p class="print-logo strong dm-mono" style="font-size:2mm"><strong>dBELGA</strong></p>');

            box.append(left);
            box.append(right);

            box.appendTo(container);
            container.appendTo(print_table);
        });

        $.each(new_products, function(index,value){
            var price = null;
            var isPrice = $('input[name="price"]').is(":checked");
            var isPromo = $('input[name="promo_price"]').is(":checked");

            if(isPromo)
                price = value.promo_price;
            else if(isPrice)
                price = value.price;

            var container = $('<div class="col"></div>');
            var box = $('<div class="`print-label-box`"></div>');

            // Left Column
            var left = $('<div class="print-label-left"></div>');

                if($('input[name="name"]').is(":checked"))
                    left.append('<p class="print-ellipsis dm-mono">'+value.name+'</p>');

                // Image
                var image = $('<img />');
                image.JsBarcode(value.code, {
                    format: "CODE128",
                    displayValue: false,
                    width: 300,
                    height: 90
                });

                left.append(image);

                if($('input[name="code"]').is(":checked"))
                    left.append('<p class="dm-mono">'+value.code+'</p>');

                if (price !== null) {
                    var pricing = $('<div class="d-flex" style="width: auto"></div>');

                    if (isPromo && isPrice)
                        pricing.append('<p style="margin-right:.25rem"><del>Rp.'+value.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</del></p>');

                    pricing.append('<p class="strong dm-mono">Rp.'+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</p>');

                    left.append(pricing);
                }

            // Right Column
            var right = $('<div class="print-label-right"></div>');
            
            right.append('<p class="print-logo strong dm-mono"><strong>dBELGA</strong></p>');

            box.append(left);
            box.append(right);

            box.appendTo(container);
            container.appendTo(htmltext);
		});

		$('#label-content').html('').append(htmltext);
		// $('#print-wrapper').shtml(print_table);
		$('#print-wrapper').html('').append(print_table);
        $('#print-barcode').modal('show');
	});

	$("#print-btn").on("click", function(){
        var element = document.getElementById('print-wrapper');
        var opt = {
            filename: 'Print Barcode',
            pagebreak: { mode: 'legacy'},
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 2, dpi: 72, letterRendering: true},
            jsPDF: {orientation: 'p', unit: 'mm', format: [ 100, 70 ]}
        };
        // html2pdf().set(opt).from(element).output().then(hide_modal_print);
        html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
            window.open(pdf.output('bloburl'), '_blank');
        });

            
        
        //   var divToPrint=document.getElementById('print-barcode');
        //   var newWin=window.open('','Print-Window');
        //   newWin.document.open();
        //   newWin.document.write('<style type="text/css">@media print { #modal_header { display: none } #print-btn { display: none } #close-btn { display: none } } table.barcodelist { page-break-inside:auto } table.barcodelist tr { page-break-inside:avoid; page-break-after:auto }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
        //   newWin.document.close();
          // setTimeout(function(){newWin.close();},10);
    });

    $('#print-barcode').on('hidden.bs.modal',function(e){
        clear_print_wrapper();
    })

    function clear_print_wrapper()
    {
        $('#print-wrapper').empty();
    }

    function hide_modal_print()
    {
        $('#print-wrapper').modal('hide');
    }

</script>
@stop
