@extends('layouts.admin')
@section('title')
    {{ isset($getshapesById) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getshapesById) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Shape</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                            <div class="bs-stepper">

                                <form id="myform" action='{{ route('admin.shapes.save') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getshapesById) ? $getshapesById->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Name"
                                                    value="{{ isset($getshapesById) ? $getshapesById->name : '' }}"
                                                    required onkeyup="createslug(this.value)"/>
                                                @error('name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('image') }}
                                                    <input type="file" name="logo" class="form-control"
                                                        id="exampleInputEmail1" onchange='openFile(event)' placeholder="Name"
                                                        required />
                                                        <img src='{{asset('uploads/shape')}}/{{isset($getshapesById) ? $getshapesById->logo : null }}' id='output' style="height:100px; width:100px; display:{{ isset($getshapesById->logo) ? 'block' : 'none' }}">
                                                    {{-- @error('name')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror --}}
                                            </div>

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        function createslug(value)
        {
            let getValue = value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
            $("#slug").val(getValue);
          // alert(getValue);
        }
    </script>
    <script>
        var openFile = function(file) {
            var input = file.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('output');
                output.src = dataURL;
                $("#output").css("display","block");
            };
            reader.readAsDataURL(input.files[0]);
        };
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        $(function() {

            $('#myform').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        // required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        minlength: 5,
                        equalTo: '#password'

                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
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
