@extends('layouts.admin')
@section('title')
    {{ isset($getattributesById) ? 'Update' : 'Add' }}
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
                        <li class="breadcrumb-item"><a href="#">Contact </a></li>
                        <li class="breadcrumb-item active">Contact</li>
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
                                <form id="myform" action='{{ route('admin.contact.save') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id' value="{{ $contact->id }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="title">{{ __('Title') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Title" value="{{ $contact->title }}" required />
                                                @error('title')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>

                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Address') }} </label>
                                                <textarea name="address"
                                                    class="ckeditor form-control">{{ $contact->address }}</textarea>

                                            </div>

                                        </div>

                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Logo') }}</label>
                                                <input type="file" name="logo" class="form-control" id="logo"
                                                    placeholder="Logo" />
                                                <img src="{{ url('public/uploads/logo/') }}/{{ $contact->logo }}"
                                                    id='output'
                                                    style="height:100px; width:100px; display:{{ $contact->logo ? 'block' : 'none' }}">
                                            </div>

                                        </div>

                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Facebook') }}</label>
                                                <input type="text" name="facebook" class="form-control" id="logo"
                                                    placeholder="Facebook" value="{{ $contact->facebook }}" />

                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Twitter') }}</label>
                                                <input type="text" name="twitter" class="form-control" id="twitter"
                                                    placeholder="Twitter" value="{{ $contact->twitter }}" />

                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Google') }}</label>
                                                <input type="text" name="google" class="form-control" id="google"
                                                    placeholder="Google" value="{{ $contact->google }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="name">{{ __('Youtube') }}</label>
                                                <input type="text" name="youtube" class="form-control" id="logo"
                                                    placeholder="Youtube" value="{{ $contact->youtube }}" />

                                            </div>

                                        </div>
                                        <div id="information-part" class="content" role="tabpanel"
                                            aria-labelledby="information-part-trigger">
                                            <button type="submit" class="btn btn-info">Update</button>
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
</script>
    <script>
        var openFile = function(file) {
            var input = file.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('output');
                output.src = dataURL;
                $("#output").css("display", "block");
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
