@extends('layouts.app')
@section('title')
{{$result[0]['title']}}
@endsection

@section('content')
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>{{$result[0]['title']}}
                    </h3>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li>></li>
                        <li>{{$result[0]['title']}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<div class="faq_content_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="faq_content_wrapper">
                    <h4>Description</h4>
                    {!!$result[0]['description']!!}
                    

                </div>
            </div>
        </div> 
    </div>    
</div>

@endsection