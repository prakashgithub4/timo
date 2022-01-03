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
                                    <th>Sub Category</th>
                                    <th>Menu Type</th>
                                    <th>icon</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              @php $count = 1; @endphp
                              @foreach($productSubCategory as $key=>$productSubCategory_item)
                                 @foreach ($productSubCategory_item['submenus'] as $submenu)
                                     
                                
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$productSubCategory_item->menu_name}}</td>
                                    <td>{{$submenu->name}}</td>
                                    <th>{{($submenu->is_mega_category == 'true')?"(Mega Menu Category)":"(Sub Menu)"}}</th>
                                    <td>@if(!is_null($submenu->icon))<img height="54" width="54" src="{{asset('public/uploads/subcat_icons/'.$submenu->icon)}}" alt="{{$productSubCategory_item->menu_name}}"/>@else N/A @endif</td>
                                    <td>
                                        <a href='{{route('admin.menu.subcat.edit',$submenu->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;
                                        <a onclick="return confirm('Are you sure?')" href="{{route('admin.menu.subcat.delete',$submenu->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php $count ++; @endphp
                                @endforeach
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
