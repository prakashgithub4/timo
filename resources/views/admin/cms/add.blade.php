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
                            {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="post"  action='{{ route('admin.cms.save') }}' id="myform">
                            @csrf
                            <input type="hidden" name="id" value="{{ isset($cms_data) ? $cms_data->id : 0  }}" />
                            <input type="hidden" name="slug" value="{{ isset($cms_data) ? $cms_data->status : ''  }}" />
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                        value="{{ isset($cms_data) ? $cms_data->title : '' }}" required>
                                    @error('title')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"
                                        value="{{ isset($cms_data) ? $cms_data->slug : '' }}" >
                                    @error('title')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div> --}}

                               
                                <div class="form-group">
                                    <label for="cms_category">Category</label>
                                        <select name="cms_category" id="cms_category"   class="form-control">
                                            <option value="">--- Select Category ---</option>
                                            @foreach($cms_category as $key => $value)
                                            <option value="{{$value->id}}" {{ isset($cms_data) ? $cms_data->cid==$value->id ? 'selected' : '' : '' }}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description"  class="form-control" required>
                                                {{ isset($cms_data) ? $cms_data->description : '' }}
                                    </textarea>
                                    @error('description')
                                        <span>{{ $message }}</span>
                                    @enderror
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

<script type="text/javascript">
    $(document).ready(function() {
       //$('.ckeditor').ckeditor();
       CKEDITOR.replace( 'description', {
    filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
    });
</script>
    <script>
        $(function() {
           
            $('#myform').validate({
                rules: {
                    description: {
                        required: true
                    },
                },
                messages: {
                    description: {
                        required: "Please enter a Description",
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
