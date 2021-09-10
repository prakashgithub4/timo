@extends('layouts.admin')
@section('content')
@section('title')
Menu Sub Category
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menu Sub Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Slider</a></li>">Menu Sub Category</a></li>
                   
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <label><a href="{{route('admin.productSubCategory.add') }}" class="btn btn-success">Add</a></label>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl/No</th>
                                    <th>Menu</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>icon</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              
                              @foreach($productSubCategory as $key=>$productSubCategory_item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$productSubCategory_item->menu_name}}</td>
                                    <td>{{$productSubCategory_item->product_category}}</td>
                                    <td>{{$productSubCategory_item->sub_category_name}}</td>
                                    <td>@if(!is_null($productSubCategory_item->icon))<img src="{{asset('public/uploads/subcat_icons/'.$productSubCategory_item->icon)}}"/>@else N/A @endif</td>
                                    <td><a onclick="return confirm('Are you sure?')" href="{{route('admin.productSubCategory.delete',$productSubCategory_item->product_sub_category_id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
@section('script')
<script>
    $(function() {
        // $("#example1").DataTable({
        //   "responsive": true, "lengthChange": false, "autoWidth": false,
        //   //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
           

        });
    });
</script>
@endsection
