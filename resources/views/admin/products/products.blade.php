@extends('layouts.admin')
@section('content')
@section('title')
    Products
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                    <li class="breadcrumb-item active">Products</li>
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
                        <label><a href="{{ route('admin.product.add') }}" class="btn btn-success">Add</a></label>
                        <label><a href="{{ route('admin.products.export') }}" class="btn btn-info">Export</a></label>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Handle</th>
                                    <th>Code</th>
                                    <th>Title</th>
                                    <th>Vendor</th>
                                    <th>Type</th>
                                    <th>Tags</th>
                                    <th>Published</th>
                                    <th>Is Purchased</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
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
    function ispublished(id,status) 
    {
        console.log(status);
         let url = "{{ url('admin/product/published/status') }}" + "/" + id+"/"+status;
        $.ajax({
                url: url,
                type: 'get',
                datatype: 'JSON'
            })
            .done(function(data) {
                $("#published_"+id).text(data);
                location.reload(true);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('error');

            });
    }
    $(function() {
        $(document).ready(function() {
            $('#example2').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "ajax": {
                    "url": "{{ route('admin.product.all') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "handle"
                    },
                    {
                        "data": "code"
                    },
                    {
                        "data": "title"
                    },
                    {
                        "data": "vendor"
                    },
                    {
                        "data": "type"
                    },
                    {
                        "data": "tags"
                    },
                    {
                        "data": "published"
                    },
                    {
                        "data": "is Purchase"
                    },
                    {
                        "data": "gender"
                    },
                    {
                        "data": "image_src"
                    },
                    {
                        "data": "options"
                    }
                ]

            });
        });
    });
    
   async function isPurchased(id,status,buttontex)
    {
      try
      {
        const result = await $.ajax({
                url: "{{ route('admin.ispurchase') }}",
                type: 'get',
                data: {
                    'product_id': id,
                    'status' : status
                }
               });
               //console.log(result)
               location.reload();
               //console.log(buttontex.value);
      }
      catch(error)
      {
          console.log(error)
      }
      
     
    }
</script>
@endsection
