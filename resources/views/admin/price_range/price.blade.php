@extends('layouts.admin')
@section('title')
    Update Price Range
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Range</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Product</a></li>
                        <li class="breadcrumb-item active">Price</li>
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
                                <form id="myform" action="{{route('admin.range.save')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{isset($get_range_by_id) ? $get_range_by_id->id : ''}}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="form-group">
                                                <label for="name">{{ __('Start') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="start" class="form-control" id="start"
                                                    placeholder="Start"
                                                    value="{{isset($get_range_by_id) ? $get_range_by_id->start_price : ''}}"
                                                    required  />
                                                @error('start')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('End') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="end" class="form-control" id="end"
                                                    placeholder="End"
                                                    value="{{isset($get_range_by_id) ? $get_range_by_id->end_price : ''}}"  
                                                    required />
                                                @error('end')
                                                    <small style="color:red">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Amount') }} <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="diff" class="form-control" id="differance"
                                                    placeholder="Amount"
                                                    value="{{isset($get_range_by_id) ? $get_range_by_id->differance : ''}}"
                                                    required/>
                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="name">{{ __('Status') }} <span
                                                        style='color:red'>*</span></label>
                                                    <select name="status" class="form-control" required>
                                                        <option selected value ="">--Select--</option>
                                                        <option {{@$get_range_by_id->status == 'active' ?'selected':''}} value="active">Active</option>
                                                        <option {{@$get_range_by_id->status == 'inactive' ? 'selected':''}} value="inactive">Inactive</option>
                                                    </select>
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
  <script>
    function calculatedifferance()
    {
        let start = $("#start").val();
        let end = $("#end").val();
        let diff = Math.abs(Number(start) - Number(end));
        if(diff > 0)
        {
         $("#button").prop('disabled', false);
        }
        else
        {
           $("#button").prop('disabled', true);
        }
        $("#differance").val(diff);
    }
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
