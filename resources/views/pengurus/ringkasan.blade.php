@extends('pengurus.master')
@section('content')
<div class="row">
    <div class="col-5">
        <table class="table table-striped table-bordered table-responsive table-hover mt-4 mb-2">
            <tr>
                <td colspan="3" class="bg-dark text-light text-center font-weight-bold">Total Infaq</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Infaq Masjid s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format($sum_infaq_masjid->total_infaq_masjid) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Infaq Sumber Web s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format($sum_infaq_v->total_infaq_web) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Total Infaq Keseluruhan s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format( $sum_infaq_v->total_infaq_web + $sum_infaq_masjid->total_infaq_masjid) }}</td>
            </tr>
        </table>    
    </div>
    <div class="col-5">
        <table class="table table-striped table-bordered table-responsive table-hover mt-4 mb-2">
            <tr>
                <td colspan="3" class="bg-dark text-light text-center font-weight-bold">Saldo Kas</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Total Infaq Keseluruhan s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format( $sum_infaq_v->total_infaq_web + $sum_infaq_masjid->total_infaq_masjid) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Total Pengeluaran s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format( $sum_pengeluaran->total_pengeluaran) }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Saldo Kas s/d Hari Ini</td>
                <td>Rp. </td>
                <td class="text-right">{{ number_format( ($sum_infaq_v->total_infaq_web + $sum_infaq_masjid->total_infaq_masjid) - $sum_pengeluaran->total_pengeluaran) }}</td>
            </tr>
        </table>
    </div>
</div>


<table class="table table-striped table-bordered table-responsive table-hover mt-4 mb-2">
    <tr>
        <td colspan="3" class="bg-dark text-light text-center font-weight-bold">Total Zakat</td>
    </tr>
    <tr>
        <td class="font-weight-bold">Zakat Masjid Uang s/d Hari Ini</td>
        <td>Rp. </td>
        <td class="text-right">{{ number_format($sum_zakat_masjid_uang->total_zakat_masjid_uang) }}</td>
    </tr>
    <tr>
        <td class="font-weight-bold">Zakat Masjid Beras s/d Hari Ini</td>
        <td class="text-right" colspan=2>{{ $sum_zakat_masjid_beras->total_zakat_masjid_beras . ' Liter'}}</td>
    </tr>
</table>




@endsection