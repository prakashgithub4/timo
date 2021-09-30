@extends('layouts.admin')
@section('title')
    {{  isset($cms_data) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{  isset($cms_data) ? 'Update' : 'Add'  }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{  isset($cms_data) ? 'Update' : 'Add'  }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="post"  action='{{ route('admin.cms_category.save') }}' id="myform">
                            @csrf
                            <input type="hidden" name="id" value="{{ isset($cms_data) ? $cms_data->id : 0  }}" />
                            <input type="hidden" name="slug" value="{{ isset($cms_data) ? $cms_data->status : ''  }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="filter_name" class="form-control" id="filter_name" placeholder="Title"
                                        value="{{ isset($cms_data) ? $cms_data->filter_name : '' }}" required>
                                    @error('filter_name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Min Range</label>
                                    <input type="number" name="min_range" class="form-control" id="min_range" placeholder="Min Range"
                                        value="{{ isset($cms_data) ? $cms_data->min_range : '' }}" required>
                                    @error('min_range')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Max range</label>
                                    <input type="text" name="max_range" class="form-control" id="max_range" placeholder="Max Range"
                                        value="{{ isset($cms_data) ? $cms_data->max_range : '' }}" required>
                                    @error('max_range')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="menu">Select Status</label>
                                    <select  name="status"  id="status" class="form-control ">
                                        <option value=" ">--- Select Status ---</option> 
                                        <option value="1" <?php if(!empty($cms_data)) echo $cms_data->status == 1? 'selected' : ''?>   > Active </option>
                                        <option value="0" <?php if(!empty($cms_data)) echo $cms_data->status == 0? 'selected' : ''?>   > In Active </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

    <script>
        $(function() {
           
            $('#myform').validate({
                rules: {
                    filter_name: {
                        required: true
                    },
                    min_range: {
                        required: true
                    },
                    max_range: {
                        required: true
                    },
                },
                messages: {
                    filter_name: {
                        required: "Please enter a Title",
                    },
                    min_range: {
                        required: "Please enter a Minimum Range",
                    },
                    max_range: {
                        required: "Please enter a Maximum Range",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
