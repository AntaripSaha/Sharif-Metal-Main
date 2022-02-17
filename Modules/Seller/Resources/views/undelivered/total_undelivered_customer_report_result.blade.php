@extends('layouts.app')
@section('css')
@endsection
@section('content')
<style>
    .m-top {
        margin-top: 2rem !important;
    }

</style>
<section class="content" id="ajaxview">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Undelivered Product Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Undelivered Product Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card_buttons">

                    <form action="{{ route('undelivered_product_search') }}" >
                     @csrf
                                         
                                       

                            <div class="row">
                    
                                <div class="col-sm-3">
                                    <label>Product Name</label>
                                    <select class="form-control-sm form-control js-example-basic-single" name="product_id">
                                        <option selected disabled>Select Product</option>
                                        @foreach ($customer as $p)
                                        <option name="customer_id" value="{{ $p->id }}">{{ $p->customer_id }} - {{ $p->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-sm-2">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-sm-2">
                                    <button class="btn btn-info btn-sm m-top" ><i
                                            class="fas fa-search"></i></button>
                                    
                                   
                               
                                </div>
                            </div>

                    </form>

                    <form action="undelivered_product_print">
                        @csrf


                        <input type="hidden" name="product_id" id="product_id" value="{{$product_id}}"  >
                        <input type="hidden" name="from_date" id="from_date" value="{{$from_date}}" >
                        <input type="hidden" name="to_date" id="to_date" value="{{$to_date}}" >

                        
                        <button type="submit" class="btn btn-primary btn-sm m-top"><i class="fa fa-print"></i><span
                                                class="ml-1">Print</span></button>
                    </form>


                    </div>
                    <div class="card-body" id="undeliveredProductTable">
                        <table id="productTable"
                            class="table table-sm table-bordered table-striped display responsive nowrap" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>SL No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Head Code</th>
                                    <th>Total Undelivered</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $i = 1;
                                $in_total_amount = 0;
                                @endphp
                                @foreach ($undelivered_products as $undelivered)
                                @if ($undelivered->undelivered_product != 0)
                                <tr class="text-center">
                                    <td>{{ $i }}</td>
                                    <td>{{ $undelivered->products->product_id }}</td>
                                    <td>{{ $undelivered->products->product_name }}</td>
                                    <td>{{ $undelivered->products->head_code}}</td>

                                    @if($undelivered->undelivered_product <= 0)
                                    <td>0</td>
                                    @else
                                    <td>{{ $undelivered->undelivered_product }}</td>
                                    @endif
                                    
                                    <td>{{ $undelivered->products->price }}</td>

                                    @if($undelivered->undelivered_product <= 0)
                                    <td>{{ $undelivered->products->price * 0 }}</td>
                                    @else
                                    <td>{{ $undelivered->products->price * $undelivered->undelivered_product }}</td>
                                    @endif

                                </tr>


                                <?php 
                                $i++;
                                if($undelivered->undelivered_product <= 0):
                                    $in_total_amount += ($undelivered->products->price * 0);
                                else:
                                    $in_total_amount += ($undelivered->products->price * $undelivered->undelivered_product);
                                endif;
                                ?>
                              
                                
                               
                               


                                @endif
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right text-bold"><strong>Total Amount</strong></td>
                                    <td class="text-center text-bold">{{ $in_total_amount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
    // Searching Function
    function searching() {
        var product_id = $('#product_id').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        if (!product_id && !from_date && !to_date) {
            swal("", "Please Select Product or Date Range", "error");
        } else {
            $('.loading').show();
            var url = baseUrl + "seller/undelivered_product_search";
            var data = {
                product_id: product_id,
                from_date: from_date,
                to_date: to_date
            };
            getAjaxView(url, data = data, 'undeliveredProductTable', false, 'get');
        }
    }
    // Refresh Function
    function refresh() {
        location.reload();
    }

</script>
@endsection
