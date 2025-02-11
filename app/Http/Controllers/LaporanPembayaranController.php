<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meteran;
use App\Models\Bulan;
use App\Models\Pembayaran;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Woo\GridView\DataProviders\EloquentDataProvider;
use Illuminate\Support\Facades\DB;

class LaporanPembayaranController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:laporan-pembayaran view', only: ['index']),
        ];
    }

    public static function index(Request $request): View
    {
        $query = Pembayaran::query();

        $query = Pembayaran::select('pembayaran.*', 'meteran.nomor_meteran', 'bulan.nama_bulan', 'pemakaian.pakai', 'tagihan.nominal')
            ->join('meteran', 'meteran.id_meteran', '=', 'pembayaran.id_meteran')
            ->join('bulan', 'bulan.id_bulan', '=', 'pembayaran.id_bulan')
            ->join('pemakaian', 'pemakaian.id_meteran', '=', 'pembayaran.id_meteran')
            ->join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.id_tagihan')
            ->where('tagihan.status_pembayaran', true) // Hanya tagihan yang sudah dibayar
            ->groupBy('pembayaran.id_pembayaran', 'meteran.nomor_meteran', 'bulan.nama_bulan', 'pemakaian.pakai') // Grouping sesuai select
            ->orderBy('pembayaran.updated_at', 'desc');

        $dataProvider = new EloquentDataProvider($query);
        $perPage = 15;

        return view('laporan-pembayaran.index', compact('dataProvider', 'perPage'))
            ->with('i', ($request->query('page', 1) - 1) * $perPage);
    }
}
