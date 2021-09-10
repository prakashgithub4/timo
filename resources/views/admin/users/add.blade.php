@extends('layouts.admin')
@section('title')
{{ isset($getCustomerbyId) ? "Update" : 'Add' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
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

                                <form id="myform" action='{{ route('admin.create.customer') }}' method="POST">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getCustomerbyId) ? $getCustomerbyId->id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Name') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Name"
                                                    value="{{ isset($getCustomerbyId) ? $getCustomerbyId->name : '' }}"
                                                    required />
                                                @error('name')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{ __('Email') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Email"
                                                    value="{{ isset($getCustomerbyId) ? $getCustomerbyId->email : '' }}"
                                                    required>
                                                @error('email')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">{{ __('Password') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Passsword" required>
                                                @error('password')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm pssword">{{ __('Confirm Password') }}<span
                                                        style='color:red'>*</span></label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    id="email" placeholder="Confirm Password">
                                            </div>


                                            <div class="form-group">
                                                <label for="email">{{ __('Phone') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="phone" class="form-control" id="email"
                                                    placeholder="Phone"
                                                    value="{{ isset($getCustomerbyId) ? $getCustomerbyId->phone : '' }}"
                                                    required>
                                                @error('phone')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            @if (isset($getCustomerbyId)&&$getCustomerbyId->user_type != 'admin')
                                                <div class="form-group">
                                                    <label for="email">{{ __('Phone') }} <span
                                                            style='color:red'>*</span></label>
                                                    <select name="gender" class="form-control" required>
                                                        <option selected value=''>Select</option>
                                                        <option
                                                            {{ empty(@$getCustomerbyId->gender == 'male') ? '' : 'selected' }}
                                                            value='male'>Male</option>
                                                        <option
                                                            {{ empty(@$getCustomerbyId->gender == 'female') ? '' : 'selected' }}
                                                            value='female'>Female</option>
                                                        <option
                                                            {{ empty(@$getCustomerbyId->gender == 'others') ? '' : 'selected' }}
                                                            value='others'>Others</option>
                                                    </select>
                                                    @error('gender')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="email">{{ __('Location') }}</label>
                                                <textarea name="address" class="ckeditor form-control" name="location">
                                                            {{ isset($getCustomerbyId) ? $getCustomerbyId->address : '' }}
                                                        </textarea>
                                            </div>
                                            <input type="hidden" name="user_type" value="customer" />
                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer">
                Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
              </div> --}}
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
