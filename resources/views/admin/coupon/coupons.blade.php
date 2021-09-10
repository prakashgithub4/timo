@extends('layouts.admin')
@section('title')
    Coupons
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Coupons</h1>
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
                        <label><a href="{{ route('admin.product.coupon.add') }}" class="btn btn-success">Add</a></label>
                        
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Coupon</th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Discount</th>
                                    <th>Create</th>
                                    <th>Expire</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupon as $key=>$coupons)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$coupons->coupon}}</td>
                                    <td>{{is_null($coupons->email) ? 'N/A':$coupons->email}}</td>
                                    <td>{{is_null($coupons->seo_title) ? 'N/A':$coupons->seo_title}}</td>
                                    <td>{{$coupons->discount}}</td>
                                    <td>{{$coupons->created_date}}</td>
                                    <td>{{$coupons->expire_date}}</td>
                                    <td>{{$coupons->status}}</td>
                                    <td><a href='{{route('admin.product.coupon.edit',$coupons->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit"></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('admin.product.coupon.remove',$coupons->id)}}"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
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
        //     $('#example2').DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "lengthChange": false,
        //         "ajax": {
        //             "url": "{{ route('admin.product.all') }}",
        //             "dataType": "json",
        //             "type": "POST",
        //             "data": {
        //                 _token: "{{ csrf_token() }}"
        //             }
        //         },
        //         "columns": [{
        //                 "data": "id"
        //             },
        //             {
        //                 "data": "handle"
        //             },
        //             {
        //                 "data": "code"
        //             },
        //             {
        //                 "data": "title"
        //             },
        //             {
        //                 "data": "vendor"
        //             },
        //             {
        //                 "data": "type"
        //             },
        //             {
        //                 "data": "tags"
        //             },
        //             {
        //                 "data": "published"
        //             },
        //             {
        //                 "data": "gender"
        //             },
        //             {
        //                 "data": "image_src"
        //             },
        //             {
        //                 "data": "options"
        //             }
        //         ]

        //     });
         });
    });
</script>
@endsection
