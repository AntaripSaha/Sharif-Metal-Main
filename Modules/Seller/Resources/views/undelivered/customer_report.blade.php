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
                    <h1 class="m-0 text-dark">Customer Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body" id="undeliveredProductTable">
                    <table id="productTable" class="table table-sm table-bordered table-striped display responsive nowrap" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>Custmer ID</th>
                                    <th>Custmer Name</th>
                                </tr>

                            </thead>

                            <tbody>
                            <tr class="text-center">
                                    <td><h5>  {{ $customer_info->customer_id }}  </h5></td>
                                    <td><h5>  {{ $customer_info->customer_name}}  </h5></td>
                            </tr>
                            </tbody>
                                                            
                    
                        </table>
                        <br> <br>
                        <table id="productTable"
                            class="table table-sm table-bordered table-striped display responsive nowrap" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>SL No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Undelivered</th>
                                </tr>
                            </thead>

                            <tbody>


                                @php
                                $i = 1;
                                $in_total_amount = 0;
                                @endphp
                                @foreach ($products as $key=>$product)
                                <tr class="text-center">
                                    <td>{{ $i }}</td>
                                    <td>{{ $product->products->product_id }}</td>
                                    <td>{{ $product->products->product_name }}</td>
                                    <td>{{ $product->products->price }}</td>
                                    <td>{{ $request_products[$key]->undelivered_product }}</td>
                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>

                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

