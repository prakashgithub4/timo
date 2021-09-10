@extends('layouts.admin')
@section('content')
@section('title')
    Menu
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menu</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Slider</a></li>">Menu</a></li>
                   
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
                        <label><a href="{{route('admin.menu.add') }}" class="btn btn-success">Add</a></label>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl/No</th>
                                    <th>Menu Title</th>
                                    <th>Status</th>
                                    <th>Mega Menu</th>
                                    <th>Set On Top</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($menu as $key=>$menu_item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$menu_item->menu_name}}</td>
                                    <td> <?php if($menu_item->status=="inactive") {?>
                                        <a class='badge badge-warning' href="{{url('/admin/menu/status/'.$menu_item->id.'/active')}}">Inactive</a>
                                        <?php } else {?>
                                        <a class='badge badge-success' href="{{url('/admin/menu/status/'.$menu_item->id.'/inactive')}}">Active</a>
                                        <?php }?>
                                        </td>

                                    <td><?php if($menu_item->top=="0") {?>
                                        <a class='badge badge-warning' href="{{url('/admin/menu/set-on-top/'.$menu_item->id.'/1')}}">Inactive</a>
                                        <?php } else {?>
                                        <a class='badge badge-success' href="{{url('/admin/menu/set-on-top/'.$menu_item->id.'/0')}}">Active</a>
                                        <?php }?></td>
                                    
                                    <td><?php if($menu_item->head_on=="0") {?>
                                    <a class='badge badge-warning' href="{{url('/admin/menu/set-on-head/'.$menu_item->id.'/1')}}">Inactive</a>
                                    <?php } else {?>
                                    <a class='badge badge-success' href="{{url('/admin/menu/set-on-head/'.$menu_item->id.'/0')}}">Active</a>
                                    <?php }?></td>
                                    
                                    <td><a href='{{route('admin.menu.edit',$menu_item->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('admin.menu.delete',$menu_item->id)}}"
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
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
           

        });
    });
</script>
@endsection
