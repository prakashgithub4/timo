@extends('layouts.admin')
@section('content')
@section('title')
   Sub Category
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sub Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                    <li class="breadcrumb-item active">Category</li>
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
                    {{--<div class="card-header">
                         <h3 class="card-title">DataTable with minimal features & hover style</h3> 
                    </div>--}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                        <label><a href="{{route('admin.category.sub.add') }}" class="btn btn-success">Add</a></label>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                              @forelse($categories as $key=>$item)
                                <tr>
                                   <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>Main</td>
                                    <td>{{$item->slug}}</td>
                                    
                                    {{-- <td><img src="{{asset('uploads/category/'.$item->image)}}" height="90px" width="90px"/></td> --}}
                                    <td>
                                        {{-- <a href='{{route('admin.category.edit',$item->id)}}' class="btn btn-info"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('admin.categories.deleted',$item->id)}}"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a> --}}
                                    </td>
                                </tr>
                                  @foreach($item->subCategories as $subCategory)
                                  <tr>
                                    <td>{{$subCategory->id}}</td>
                                    <td>{{$subCategory->name}}</td>
                                    <td>Sub</td>
                                    <td>{{$subCategory->slug}}</td>
                                    {{-- <td><img src="{{asset('uploads/category/'.$item->image)}}" height="90px" width="90px"/></td> --}}
                                    <td><a href='{{route('admin.category.sub.edit',$subCategory->id)}}' class="btn btn-info"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('admin.categories.sub.deleted',$subCategory->id)}}"
                                            class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                  
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
