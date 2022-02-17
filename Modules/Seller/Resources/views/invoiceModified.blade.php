<!DOCTYPE html>
<html>

<head>
    {!! isset($pdf_style) ? $pdf_style : '' !!}
            <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                /** Extra personal styles **/
                color: #000;
            }
            table {
                border-left: 0.01em solid #ccc;
                border-right: 0;
                border-top: 0.01em solid #ccc;
                border-bottom: 0;
                border-collapse: collapse;
            }
            table td,
            table th {
                border-left: 0;
                border-right: 0.01em solid #ccc;
                border-top: 0;
                border-bottom: 0.01em solid #ccc;
            }
            table { width: 100%; }
            table th, table td { width: 25%; }

            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 1.04cm; 
                right: 0cm;
                height: 2cm;
                margin-top: 2cm;

                /** Extra personal styles **/
                /* background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1.5cm; */
            }
        </style>
</head>





<body style="width: 90%;margin: auto;">
    <div class="card">
        <div class="card-header">
            <div class="col-md-6" style="text-align: center;margin-top: 20px;">
                <p style="font-size:22px;padding: 2px 8px 2px 8px;border:4px double #000;display: inline-block;margin-left:45%;">
                    <span style="font-size:28px;">{{$title}}</span>
                </p><br>
                <span style="font-size: 34px;font-weight: bold">{{strtoupper($company_info->name)}}</span><br>
                <span style="font-size: 20px;">{{$company_info->address}}</span><br><br>
            </div>
            <div class="col-md-12">
                <span style="font-size: 18px; text-align: right;float: right;">Date :
                    {{ Carbon\Carbon::parse($chalan->del_date)->format('d-m-Y') }}</span><br><br>
                <span style="font-size: 18px; text-align: left;float: left; width: 40%">Bill No :
                    {{$chalan->req_id}}</span>
                {{-- <span style="font-size: 18px; text-align: left;float: left;width: 0%">Challan No : {{$chalan->challan_no}}</span>
                --}}
                {{-- <span style="font-size: 18px; text-align: left;float: right;">P.O No : {{$chalan->po_code}}</span>
                --}}
                <span style="font-size: 18px; text-align: left;float: right;">Challan No :
                    {{$chalan->challan_no}}</span>
                <br>
            </div>
            <div class="col-md-12" style="margin-top: 7px">
                <span style="text-align: left;float: left;font-size: 18px;">Name :
                    {{$chalan->customer->customer_name}}</span>

                <span style="text-align: right;float: right;font-size: 18px;">P.O No : {{$chalan->po_code}}</span><br>
            </div>

            <div class="col-md-12" style="margin-top: 7px">
                <span style="text-align: left;float: left;font-size: 18px;">
                    Sales Person Name :
                    {{$sales_person_name->name}} - {{$sales_person_name->user_id}} </span>

            </div>
            <br>

            <div class="col-md-12" style="margin-top: 7px">
                <span style="text-align: left;float: left;font-size: 18px;">Address :
                    {{$chalan->pname}}</span><br>

            </div>


            <div class="col-md-12" style="margin-top: 7px">
                @if( $chalan->gift )
                <span style="text-align: left;float: left;font-size: 18px;">Remarks :
                    {{$chalan->gift}}</span>
                <span style="text-align: right;float: right;font-size: 18px;">D/C.O Code :
                    {{$chalan->dco_code}}</span><br>
                @else
                <span style="text-align: left;float: left;font-size: 18px;">D/C.O Code :
                    {{$chalan->dco_code}}</span><br>
                @endif

            </div>

        </div>
        <br>
        <!-- /.card-header -->
        <div class="card-body" id="ledger_view">
            <table id="print_code" style="width: 630px;">
          
                   <thead>
                    <tr style="width:100px">
                        <th style="width:20px">SL.No</th>
                        <th style="width:100px">Products Code</th>
                        <th style="width:300px !important;">Product Name</th>
                        <th style="width:25px">Head</th>
                        <th style="width:30px">QTY</th>
                        <th style="width:70px !important">Unit Price</th>
                        <th style="width:70px">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sum_total = 0;
                    $sl = 0;
                    ?>

                    @foreach($products as $key => $product)
                    <?php $sl = $sl + 1; ?>

                                    <tr style="margin-top:5px;">
                                        <td style="text-align: center; width: 20px; height: 29px;">{{$loop->index + 1}}</td>
                                        <td style="text-align: center; width: 10px;">{{$product->products->product_id}}</td>
                                        <td style="max-width: 200px !important;">{{$product->products->product_name}}</td>
                                        <td style="text-align: center; width: 20px;">
                                            @if ($product->products->head_code)
                                            {{ $product->products->head_code }}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td style="text-align: center; width: 20px;">{{$product->del_qnt}}</td>
                                        <td style="text-align: center; width: 20px;">{{number_format($product->products->price, 2)}}</td>
                                        <td style="text-align: center; width: 15px;">{{number_format($product->del_qnt * $product->products->price, 2)}}
                                            <?php $sum_total += $product->del_qnt * $product->products->price ?></td>
                                    </tr>
                 
                    @endforeach

                </tbody>

            <div style="page-break-inside: avoid" >
                <table id="print_code" style="width: 666.35px; margin-top: 0px; margin-bottom: 0px;">
                    <div style="page-break-before: auto" > </div>
                        <tbody>
                            <tr>
                                <td class="text-left" colspan="3" rowspan="4"><b style="font-size: 16px;">Taka(In
                                  Words):</b><span style="font-size: 16px; margin-top: 0px;"> {{$amount}} </span></td>
                                <td colspan="2" style="padding: 5px;"><b style="font-size: 16px;">Total(Tk.)</b></td>
                                <td style="text-align: right;" colspan="2"><span style="margin-right: 13%;">=<?php echo (number_format($sum_total, 2 , '.', ',')) ?>/=</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 5px;"><b style="font-size: 16px;">Discount(%)</b></td>
                                <td style="text-align: right;" colspan="2">
                                <span style="margin-right: 13%;">
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
                                </span>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="padding: 5px;"><b style="font-size: 16px;">Discount Amt.</b></td>
                                <td style="text-align: right;" colspan="2"><span style="margin-right: 13%;">({{ number_format((int)$chalan->del_discount, 2)}})</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 5px;"><b style="font-size: 16px;">Grand Total</b></td>
                                <td style="text-align: right;" colspan="2"><span style="margin-right: 13%;">={{number_format((int)$chalan->del_amount, 2)}}/=</span></td>
                            </tr>
                        </tbody>
                </table>

                <footer>
                    <div class="col-md-12">
                        <div style="float: left;">
                            <br><br><br><br>
                            <span style="font-size: 18px; flex: left; margin-top: 10px; border-top: 2px solid #000; padding:2px;"><b>Received
                                With Seal</b>
                            </span>
                        </div>
                                    <div style="float: right;">
                                        <br><br><br><br>
                                        <span style="font-size: 18px; flex: left; margin-top: 10px; border-top: 2px solid #000;"><b>For :
                                            {{$company_info->name}}</b>
                                        </span>
                                    </div> 
                    </div>     
                </footer>
            </div>
        </div>
    </div>
</div>
</body>


     

</html>