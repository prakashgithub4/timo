@extends('layouts.app')
@section('content')
<!--error section area start-->
<div class="error_section">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="error_form">
                    <h1>401</h1>
                    <h2>Opps! PAGE Unauthorized</h2>
                    <p>@section('message', __('Unauthorized'))</p>
                    <a href="{{url('/')}}">Back to home page</a>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
<!--error section area end--> 