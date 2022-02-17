@extends('layouts.app')
@section('css')
@endsection
@section('content')

<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>

<!-- Main content -->
<section class="content" id="ajaxview">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('product.products')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@lang('product.products')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card_buttons" style="display: inline-flex;">
                        <h3 class="card-title">@lang('product.product_list')</h3>
                         @if(\Auth::user()->can('add_product',app('\Modules\Product\Entities\Product')) ||
                        Auth::user()->isOfficeAdmin())
                        <button type="button" class="add_product btn btn-success btn-sm" style="margin-left:auto;">
                            <i class="fas fa-plus"></i>
                            @lang('product.add_product')
                        </button>
                        &nbsp;&nbsp;
                        <form action="{{route('product.download')}}" method="post">
                            @csrf
                        <button  type="submit" id="sub" class=" btn btn-info btn-sm float-right">
                            <i class="fas fa-download"></i>
                            Download
                        </button>
                        </form>

                        &nbsp;&nbsp;




                        <div class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Modal body text goes here.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>


                        <form action="{{route('product.upload')}}" method="post">
                            @csrf
                            <button  type="submit" id="sub" class=" btn btn-danger btn-sm float-right">
                            <i class="fas fa-upload"></i>
                                  Upload
                            </button>
                        </form>
                        @endif
                    </div>

              
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="productTable" class="table table-sm table-bordered table-striped display responsive nowrap"
                            width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Product Code</th>
                                    <th>Head</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('js')

<script src="{{asset('js/Modules/Product/product_index.js')}}"></script>

@endsection
