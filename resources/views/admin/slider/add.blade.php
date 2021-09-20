@extends('layouts.admin')
@section('title')
    {{ isset($getSlider) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($getSlider) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Slider</a></li>
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

                                <form id="myform" action='{{ route('admin.slider.save') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getSlider) ? $getSlider->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                        <div class= "row"> 
                                         

                                            <div class="form-group col-md-6">
                                                <label for="name">{{ __('Title') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                                    placeholder=" Title"
                                                    value="{{ isset($getSlider) ? $getSlider->title : '' }}"
                                                    required "/>
                                                @error('title')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>  

                                             <div class="form-group col-md-6">
                                                <label for="name">{{ __('Discount Title') }} </label>
                                                <input type="text" name="discount_title" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Discount Title"
                                                    value="{{ isset($getSlider) ? $getSlider->discount_title : '' }}"
                                                   />
                                                @error('discount_title')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                            
                                        <div class= "row">   
                                           <!--  <div class="form-group col-md-6">
                                                
                                                <label for="name">{{ __('Price') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="number" name="price" class="form-control" id="exampleInputEmail1"
                                                    placeholder=" Price"
                                                    value="{{ isset($getSlider) ? $getSlider->price : '' }}"
                                                    required >
                                                @error('price')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div> -->

                                            <div class="form-group col-md-6">
                                                <label for="name">{{ __('Url') }} <span
                                                        style='color:red'>optional</span></label>
                                                <input type="text" name="url" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Url"
                                                    value="{{ isset($getSlider) ? $getSlider->url : '' }}"
                                                     >
                                                @error('url')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">{{ __('Image') }}
                                                    <input type="file" name="image" class="form-control"
                                                        id="exampleInputEmail1" onchange='openFile(event)' placeholder="Image"
                                                        value="{{ isset($getColorbyId) ? $getColorbyId->image : '' }}"
                                                        {{isset($getColorbyId->image)? 'required': '' }}
                                                         />
                                                        <img src='{{asset('public/uploads/slider')}}/{{isset($getSlider) ? $getSlider->image : null }}' id='output' style="height:100px; width:100px; display:{{ isset($getSlider->image) ? 'block' : 'none' }}">
                                                    @error('image')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
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
