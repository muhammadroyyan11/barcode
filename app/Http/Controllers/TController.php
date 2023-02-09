<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models as Md;
use DB;
use Response;


class TController extends Controller
{
    public function tes_cetak_label(Request $request)
    {
        // $lims_product_list = DB::table('m_produk')
        //                     // ->join('m_harga_produk','m_harga_produk.produk','=','m_produk.id')
        //                     // ->where('m_harga_produk.gh_code','STD')
        //                     ->get();

        $query = DB::table('m_produk')->select('m_produk.name','m_produk.code','m_produk.id','m_produk.barcode','m_produk.price','m_produk.promo_price');

        $lims_product_list = $query->get();

        return view('tes-cetak-label-fix',compact('lims_product_list'));
    }

    public function searchProduk(Request $request)
    {
        $todayDate = date('Y-m-d');
        $product_code = explode(" ", $request['data']);

        $lims_product_data = DB::table('m_produk')->where('code', $product_code[0])->first();
        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->price_eceran;

        $product[] = $lims_product_data->barcode;
        $product[] = $lims_product_data->promo_price;
        return $product;
    }

    public function tes_cetak_tag()
    {
        return view('tes-cetak-tag');
    }

    // public function getProduk()
    // {
    //     $product = DB::table('m_produk')->orderBy('m_produk.name','asc')->get();

    //     return $product;

    // }

    public function getProduk()
    {
        
        $query = DB::table('m_produk')->select('m_produk.name','m_produk.code','m_produk.id','m_produk.barcode','m_produk.price','m_produk.promo_price');

        $lims_product_list = $query->get();

        return $lims_product_list;

    }
}
