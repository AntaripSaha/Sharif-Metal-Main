<!DOCTYPE html>
<html>

<head>
    {!! isset($pdf_style) ? $pdf_style : '' !!}
    <style>
        td {
            border-bottom: 2px solid black;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body style="margin:0%; margin-top:0%; margin-bottom:0%; font-weight: 650; line-height: 1.25;">
    <div class="container">
        <div class="row">
        <div>
            <div >
                <div class="col-md-12" style="text-align: center;margin-top: 10px;">
                    <p
                        style="font-size:22px;padding: 2px 8px 2px 8px;border:4px double #000;display: inline-block;margin-left:0%;">
                        <span style="font-size:30px;">{{$title}}</span></p><br>
                    <span style="font-size: 35px;font-weight: bold">{{strtoupper($company_info->name)}}</span><br>
                    <span style="font-size: 22px;">{{$company_info->address}}</span><br><br>
                </div>
                <div class="col-md-12">
                    <span style="font-size: 20px; text-align: right;float: right;">Date :
                        {{ Carbon\Carbon::parse($chalan->del_date)->format('d-m-Y') }}</span><br><br>
                    <span style="font-size: 20px; text-align: left;float: left; width: 30%">Bill No :
                    @php 
                    $str = $chalan->req_id;
                    $cha = $chalan->voucher_no;
                    $a = explode("-",$str);
                    $b = explode("-", $cha);
                    echo $a[0];
                    echo "-";
                    echo $b[0];
                    echo "-";
                    echo $a[2];
                    @endphp
                        </span>
                    {{-- <span style="font-size: 20px; text-align: left;float: left;width: 0%">Challan No : {{$chalan->voucher_no}}</span>
                    --}}
                    {{-- <span style="font-size: 20px; text-align: left;float: right;">P.O No : {{$chalan->po_code}}</span>
                    --}}
                    <span style="font-size: 20px; text-align: left;float: right;">Challan No :
                        {{$chalan->voucher_no}}</span>
                    <br>
                </div>
                <div class="col-md-12" style="margin-top: 7px">
                    <span style="text-align: left;float: left;font-size: 20px;">Name :
                        {{$chalan->customer->customer_name}}</span>

                    <span style="text-align: right;float: right;font-size: 20px;">P.O No : {{$chalan->po_code}}</span><br>
                </div>

                <div class="col-md-12" style="margin-top: 7px">
                    <span style="text-align: left;float: left;font-size: 20px;">
                        Sales Person Name :
                        {{$sales_person_name->name}} - {{$sales_person_name->user_id}} </span>

                </div>
                <br>

                <div class="col-md-12" style="margin-top: 7px">
                    <span style="text-align: left;float: left;font-size: 20px;">Address :
                        {{$chalan->pname}}</span><br>

                </div>
                
                
                <div class="col-md-12" style="margin-top: 7px">
                    @if( $chalan->gift )
                    <span style="text-align: left;float: left;font-size: 20px;">Remarks :
                        {{$chalan->gift}}</span>
                    <span style="text-align: right;float: right;font-size: 20px;">D/C.O Code :
                    {{$chalan->dco_code}}</span><br>
                    @else
                    <span style="text-align: left;float: left;font-size: 20px;">D/C.O Code :
                    {{$chalan->dco_code}}</span><br>
                    @endif

                </div>

            </div>
        <br>
        <!-- /.card-header -->
        <div class="card-body" id="ledger_view">
            <table id="print_code" style="width: 940px;">
                <thead>
                <tr>
                        <th style="width:10px; text-align:center; font-size:20px !important;">SL.No</th>
                        <th style="width:30px; text-align:center; font-size:20px !important;">Products Code</th>
                        <th style="width:350px; text-align:center; font-size:20px !important;">Product Name</th>
                        <th style="width:10px; text-align:center; font-size:20px !important;">Head</th>
                        <th style="width:20px; text-align:center; font-size:20px !important;">QTY</th>
                        <th style="width:25px; text-align:center; font-size:20px !important;">Unit Price</th>
                        <th style="width:25px; text-align:center; font-size:20px !important;">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $sum_total = 0;
                    ?>

                    @foreach($products as $key => $product)
                    <tr style="margin-top:5px;">
                        <td style="text-align: center; font-weight: 650; width: 20px; height: 29px;font-size:20px!important;">{{$loop->index + 1}}</td>
                        <td style="text-align: center; width: 10px;font-size:18px!important;">{{$product->products->product_id}}</td>
                        <td style="max-width: 200px; text-align:left; padding:5px; font-size:18px!important;">{{$product->products->product_name}}</td>
                        <td style="text-align: center; width: 20px;font-size:20px!important;">
                            @if ($product->products->head_code)
                            {{ $product->products->head_code }}
                            @else
                            -
                            @endif
                        </td>
                        <td style="text-align: center; width: 20px;font-size:20px!important;">{{$product->del_qnt}}</td>
                        <td style="text-align: center; width: 20px;font-size:20px!important;">{{number_format($product->unit_price, 2)}}</td>
                        <td style="text-align: center; width: 15px;font-size:20px!important;">{{number_format($product->del_qnt * $product->unit_price, 2)}}
                            <?php $sum_total += $product->del_qnt * $product->unit_price; ?></td>
                    </tr>
                    @endforeach

                    <?php $pcount = $products->count();?>
                    @if($pcount<10) @for ($i=$pcount; $i < 10; $i++) <tr>
                        <td style="padding: 8px; text-align: center; width: 20px;font-size:20px!important;">{{$i+1}}</td>
                        <td style="padding: 8px; text-align: center; width: 10px;"></td>
                        <td style="padding: 8px; min-width: 200px !important;"></td>
                        <td style="padding: 8px; text-align: center; width: 20px;"></td>
                        <td style="padding: 8px; text-align: center; width: 20px;"></td>
                        <td style="padding: 8px; text-align: center; width: 20px;"></td>
                        <td style="padding: 8px; text-align: center; width: 15px;"></td>
                        </tr>
                        @endfor
                        @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-left" colspan="3" rowspan="4"><b style="font-size: 18px;">Taka(In
                                Words):</b><span style="font-size: 20px; margin-top: 0px;"> {{$amount}} </span></td>
                        <td colspan="2" style="padding: 5px;"><b style="font-size: 20px;">Total(Tk.)</b></td>
                        <td style="text-align: right;font-size: 20px !important;" colspan="2"><span
                                style="margin-right: 13%;">=<?php echo (number_format($sum_total, 2 , '.', ',')) ?>/=</span></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="padding: 5px;"><b style="font-size: 20px;">Discount(%)</b></td>
                        <td style="text-align: right;font-size: 20px !important;" colspan="2"><span style="margin-right: 13%;">
                                @php
                                $sale_discount = $chalan->sale_disc;
                                if($chalan->sale_discount_overwrite != null){
                                $sale_discount = $chalan->sale_discount_overwrite;
                                }else{
                                if($chalan->sale_disc == null){
                                $sale_discount = 0;
                                }else{
                                $sale_discount;
                                }
                                }
                                @endphp
                                {{ $sale_discount }}%
                            </span></td>
                    </tr>

                    <tr>
                        <td colspan="2" style="padding: 5px;"><b style="font-size: 20px;">Discount Amt.</b></td>
                        <td style="text-align: right;font-size: 20px !important;" colspan="2"><span
                                style="margin-right: 13%;">({{ number_format((int)$chalan->del_discount, 2)}})</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 5px;"><b style="font-size: 20px;">Grand Total</b></td>
                        <td style="text-align: right;font-size: 20px !important;" colspan="2"><span
                                style="margin-right: 13%;">={{number_format((int)$chalan->del_amount, 2)}}/=</span></td>
                    </tr>
                </tfoot>

            </table>
            <br>

            <div class="col-md-12">
                <div style="float: left;">
                    <br><br><br><br>
                    <span style="font-size: 20px; float: left;margin-top: 10px;border-top: 2px solid #000;"><b>Received
                            With Seal</b></span>
                </div>
                <div style="float: right;">
                    <br><br><br><br>
                    <span style="font-size: 20px; float: left;margin-top: 10px;border-top: 2px solid #000;"><b>For :
                            {{$company_info->name}}</b></span>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</body>

</html>
