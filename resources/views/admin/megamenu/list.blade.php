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
                <h1>Mega Menu Sub Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"></a></li>Mega Menu Sub Category</a></li>
                   
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
                        <label><a href="{{route('admin.megamenu.category.add') }}" class="btn btn-success">Add</a></label>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sl/No</th>
                                    <th>Mega Menu Category</th>
                                    <th>Mega Menu Sub Category</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                               
                              @foreach($productSubCategory as $key=>$productSubCategory_item)
                             
                                
                                     
                                
                                <tr>
                                    
                                    <td>{{$key + 1}}</td>
                                    <td>{{$productSubCategory_item->name}}</td>
                                    <td>
                                        <ol>
                                        @foreach($productSubCategory_item['megamenu'] as $megacat)
                                        <li>{{$megacat->name}}</li>
                                        <li><button class="badge badge-danger" onclick="removesubmenu({{$megacat->id}})">X</button></li>
                                        @endforeach
                                        </ol>
                                    </td>
                                    {{-- <td>
                                        <a href='{{route('admin.menu.subcat.edit',$submenu->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;
                                        <a onclick="return confirm('Are you sure?')" href="{{route('admin.menu.subcat.delete',$submenu->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td> --}}
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
    async function removesubmenu(id)
    {
      const result = await $.ajax({
         url:"{{route('admin.mega.menu.cat.sub')}}",
         type:'GET',
         data:{id:id}
      });
      if(result.stat == true)
      {
          alert(result.message)
          location.reload();
      }
    }
</script>
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
