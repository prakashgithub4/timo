@extends('layouts.admin')
@section('content')
@section('title')
    Attributes
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subscribers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                    <li class="breadcrumb-item active">Subscribers</li>
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
                        <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('admin.shareall.subscribers') }}">Share All</button>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="master"></th>
                                    <th>S.L</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($subscriber as $key=>$item)
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td><a href="{{$item->link}}">Link</a></td>
                                    <td><a href='{{route('admin.subscribers.edit',$item->id)}}' class="btn btn-info btn-sm"><i
                                                class="fas fa-edit "></i></a>&nbsp;<a onclick="return confirm('Are you sure?')" href="{{route('admin.subscribers.share', $item->id)}}"
                                            class="btn btn-info btn-sm"><i class="far fa-share-square"></i></a>
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

    $(document).ready(function () {


$('#master').on('click', function(e) {
 if($(this).is(':checked',true))  
 {
    $(".sub_chk").prop('checked', true);  
 } else {  
    $(".sub_chk").prop('checked',false);  
 }  
});


$('.delete_all').on('click', function(e) {


    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
        allVals.push($(this).attr('data-id'));
    });  


    if(allVals.length <=0)  
    {  
        alert("Please select row.");  
    }  else {  


        var check = confirm("Are you sure?");  
        if(check == true){  


            var join_selected_values = allVals.join(","); 


            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'ids='+join_selected_values,
                success: function (data) {
                    if (data['success']) {
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        }  
    }  
});

});
</script>
@endsection
