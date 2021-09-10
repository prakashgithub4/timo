@extends('layouts.admin')
@section('title')
{{ isset($getMenu) ? 'Update Menu Category' : 'Add Menu Category' }}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($getMenu) ? 'Update Menu Category' : 'Add Menu Category' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Slider</a></li>">Menu Category</a></li>
                    <li class="breadcrumb-item active">{{ isset($getMenu) ? 'Edit' : 'Add' }} </li>
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

                            <form id="myform" action='{{ route('admin.productCategory.save') }}' method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name='id'
                                    value="{{ isset($getMenu) ? $getMenu->product_category_id : 0 }}" />
                                <div class="bs-stepper-content">
                                    <!-- your steps content here -->
                                    <div id="logins-part" class="content" role="tabpanel"
                                        aria-labelledby="logins-part-trigger">
                                    
                                    <div class="form-group col-md-6">
                                        <label for="menu">MENU</label>
                                       
                                        <select  name="menu_id" class="form-control ">
                                        @if(empty($getMenu))
                                            <option value=" ">--- Select Menu ---</option> 
                                        @endif
                                        @foreach ($menu as $my )
                                        
                                            <option value="<?php echo $my->id ?>" <?php if(!empty($getMenu)) echo $getMenu->menu_id == $my->id? 'selected' : ''?>   > {{ $my->menu_name }} </option>
                                        @endforeach
                                        </select>
                                      
                                  
                                     
                                        </div>

                                        <div class="form-group col-md-6">
                                            
                                            <label for="name">{{ __(' MENU CATEGORY NAME ') }} <span
                                                    style='color:red'>*</span></label>
                                            <input type="text" name="product_category" class="form-control" id="exampleInputEmail1"
                                                placeholder=" menu name"
                                                value="{{ isset($getMenu) ? $getMenu->product_category : '' }}"
                                                required >
                                            @error('menu')
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
