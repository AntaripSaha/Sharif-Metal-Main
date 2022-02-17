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
                                    <label>From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-sm-2">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-info btn-sm m-top" ><i
                                            class="fas fa-search"></i></button>
                                    <button class="btn btn-success btn-sm m-top" onclick="refresh()"><i
                                            class="fas fa-sync-alt"></i></button>
                                        
                                    <!-- <button  class="btn btn-primary btn-sm m-top"><i class="fa fa-print"></i><span
                                                class="ml-1">Print</span></button> -->
                               
                                </div>
                            </div>



                    </form>




                    </div>

                        <div class="card-body" id="undeliveredProductTable">
                            <table id="productTable"
                                class="table table-sm table-bordered table-striped display responsive nowrap" width="100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>SL No</th>
                                        <th>Customer Code</th>
                                        <th>Customer  Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>


                                    @php
                                    $i = 1;
                                    $in_total_amount = 0;
                                    @endphp
                                    @foreach ($customers as $key=>$customer)
                                    <tr class="text-center">
                                        <td>{{ $i }}</td>
                                        <td>{{ $customer->customer_id }}</td>
                                        <td>{{ $customer->customer_name }}</td>
                                        <td>
                                            <a href="{{route('customer_report', $customer->id)}}" class="btn btn-outline-success btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                  
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
</section>
@endsection

