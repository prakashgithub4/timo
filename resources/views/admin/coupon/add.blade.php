@extends('layouts.admin')
@section('title')
    {{ isset($getColorbyId) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> {{ isset($getColorbyId) ? 'Update' : 'Add' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Color</a></li>
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
                                   @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                   @endif
                                <form id="myform" action="{{route('admin.product.coupon.create')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{isset($coupon) ? $coupon->id : ''}}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Product') }} 
                                                    <!-- <span style='color:red'>*</span> -->
                                                    </label>
                                                        <select name='product' class="form-control" >
                                                            <option disabled  selected>--Select --</option>
                                                            @foreach($product as $products)
                                                            <option {{(@$coupon->product_id == $products->id) ? 'selected': ''}} value='{{$products->id}}'>{{$products->seo_title}}</option>
                                                            @endforeach
                                                        </select>
                                                
                                                @error('product')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                             <div class="form-group">
                                                <label for="name">{{ __('User') }} 
                                                    <!-- <span style='color:red'>*</span> -->
                                                    </label>
                                                        <select name='user' class="form-control" >
                                                            <option disabled  selected>--Select --</option>
                                                            @foreach($user as $users)
                                                            <option {{(@$coupon->user_id == $users->id) ? 'selected': ''}} value='{{$users->id}}'>{{$users->email}}</option>
                                                            @endforeach
                                                        </select>
                                                
                                                @error('user')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Coupon') }} <!-- <span
                                                        style='color:red'>*</span> -->
                                                        </label>
                                                <input type="text" name="coupon" class="form-control" id="end"
                                                    placeholder="Coupon"
                                                    value="{{isset($coupon) ? $coupon->coupon : ''}}"/>
                                                @error('coupon')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Discount %') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="discount" class="form-control" id="differance"
                                                    placeholder="discount"
                                                    value="{{isset($coupon) ? $coupon->discount : ''}}"
                                                    required/>
                                                @error('discount')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Create ') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="create_date" class="form-control" id="differance"
                                                    placeholder="discount"
                                                    value="{{isset($coupon) ? $coupon->created_date : ''}}"
                                                    required/>
                                                @error('create_date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Expire') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="date" name="expire_date" class="form-control" id="differance"
                                                    placeholder="discount"
                                                    value="{{isset($coupon) ? $coupon->expire_date : ''}}"
                                                    required/>
                                                @error('expire_date')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Status') }} <span
                                                        style='color:red'>*</span></label>
                                                    <select name="status" class="form-control" required>
                                                        
                                                        <option selected value="pending">Pending</option>
                                                        <option {{@$coupon->status == 'apply' ? 'selected':''}} value="inactive">Apply</option>
                                                        <option {{@$coupon->status == 'expired' ? 'selected':''}} value="inactive">Expired</option>
                                                    </select>
                                                @error('status')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary" id ="button" >Submit</button>
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
