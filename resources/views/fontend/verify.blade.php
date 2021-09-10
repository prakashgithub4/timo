@extends('layouts.app')
@section('title')
Verify
@endsection
@section('content')
    <div class="signup_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="progress_blk">
                        <div class="progess_line">
                            <div class="step_group">
                                <div class="steps"></div>
                                <div class="steps active"></div>
                                <div class="steps"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="signUp_block">
                        <div class="signUp_frame">
                            <form>
                                <div class="sign_top">
                                    <h3>Verify Your Email Address</h3>
                                    <label>Security Code sent to your Email Address. <br> Creck your email.</label>
                                </div>
                                <div class="main_form d-flex flex-column align-items-center">
                                    <div class="form-group w-100 varify_blk">
                                        <label for="securityCode">Enter the Security Code Here....</label>
                                        <input type="text" class="form-control mt-3" id="exampleInputEmail1"
                                            aria-describedby="securutyHelp" placeholder="Enter Security Code"
                                            onblur="checkverified(this.value)">
                                        <div class="varified mt-2"><img id="verified" style="display:none"
                                                src="{{ asset('assets/fontend/img/icon/varified.png') }}"></div>
                                    </div>


                                    <button type="button" id="button" disabled onclick="goLogin()" class="btn btn-primary w-50 mt-5">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="col-md-7 text-right">
                    <div class="image_blk veryfi">
                        <img src="{{ asset('assets/fontend/img/background/ring_log.png') }}">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function checkverified(val) {
            $.ajax({
                type: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "code": val
                },
                url: "{{ route('user.varified') }}",
                success: function(response) {
                    console.log(response)
                    if(response == 1)
                    {
                        $("#verified").css({"display":"block"});
                        $("#button").attr('disabled', false);

                    }
                    else
                    {
                        $("#verified").css({"display":"none"});
                        $("#button").attr('disabled', true);

                    }
                }
            });
        }
        function goLogin()
        {
            window.location = "{{route('user.login')}}";
        }
    </script>
@endsection
