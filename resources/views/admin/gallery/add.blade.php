@extends('layouts.admin')
@section('title')
    {{ isset($getCategorybyid) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($getCategorybyid) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Gallery</a></li>
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
                        <div class="card-body">
                            <div class="bs-stepper">

                                <form id="myform" action="{{ route('admin.gallery.save') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='product_id'
                                        value="{{$product_id}}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content addmore" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            
                                            <div class="form-group">
                                               <div class="row">
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-success" onclick="addmore()">+</button>
                                                    </div>
                                                   <div class="col-md-4">
                                                      <label for="name">{{ __('Image') }}</label>
                                                    <input type="file" name="image[]" class="form-control"
                                                        id="exampleInputEmail1" onchange='openFile(event)' placeholder="Name"
                                                        value="{{ isset($getColorbyId) ? $getColorbyId->name : '' }}"
                                                        required />
                                                        {{-- <img src='{{asset('public/uploads/category')}}/{{isset($getCategorybyid) ? $getCategorybyid->image : null }}' class='output' style="height:100px; width:100px; display:{{ isset($getCategorybyid->image) ? 'block' : 'none' }}"> --}}
                                                    {{-- @error('image')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror --}}
                                                  </div>
                                                  <div class="col-md-4">
                                                    
                                                </div>
                                                </div>
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
        // var openFile = function(file) {
        //     var input = file.target;
        //     var reader = new FileReader();
        //     reader.onload = function() {
        //         var dataURL = reader.result;
        //         var output = document.getElementsByClassName('output');
        //         output.src = dataURL;
        //         $(".output").css("display","block");
        //     };
        //     reader.readAsDataURL(input.files[0]);
        // };
    </script>
    <script type="text/javascript">
       
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
    <script>
        var count = 1;
        function addmore()
        {
          if(count <= 5)
          {
            $('.addmore').append(`<div class="form-group" id="remove_${count}">
                                               <div class="row">
                                                    <div class="col-md-4">
                                                        
                                                    </div>
                                                   <div class="col-md-4">
                                                      <label for="name">{{ __('Image') }}</label>
                                                    <input type="file" name="image[]" class="form-control"
                                                        id="exampleInputEmail1" onchange='openFile(event)' placeholder="Name"
                                                        value=""
                                                        required />
                                                  </div>
                                                  <div class="col-md-4">
                                                    <button type="button" class="btn btn-danger" onclick="remove(${count})">-</button>
                                                </div>
                                                </div>
                                            </div>`);
          }
          else
          {
            $.toast({
                        heading: 'error',
                        text: 'Cant add more image',
                        icon: 'error',
                        position: 'top-right'
                    });
          }
          
                 count ++;

        }
        function remove(id)
        {
          $("#remove_"+id).remove();
        }
    </script>
@endsection
