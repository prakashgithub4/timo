@extends('layouts.admin')
@section('title')
    {{ isset($getMenu) ? 'Update Menu Category' : 'Add Sub Menu Category' }}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($getMenu) ? 'Update Menu Category' : 'Add Sub Menu Category' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Slider</a></li>">Sub Menu Category</a></li>
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
                        <div class="card-body p-0">
                            <div class="bs-stepper">

                                <form id="myform" action='{{route('admin.update.subcat')}}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id' value="" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                           

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4"  id="menu_category">
                                                    <label for="menu">MENU SUB CATEGORY </label>

                                                    <input type="hidden" name="id" value="{{$editsubmenu->id}}"/>
     
                                                    <input type="text" name="menu_sub_name" class="form-control" value="{{$editsubmenu->name}}" placeholder="Sub Category Name"/>
                                                    @error('menu_sub_name')
                                                      <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                           

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4" 
                                                    id="menu_product_icon">
                                                    <input type="hidden" name="hidden_file" value="" />

                                                    <label for="name">{{ __(' SUB CATEGORY ICON ') }}(15 x 15)</label>
                                                    <input type="file" name="sub_category_icon" class="form-control"
                                                        placeholder=" subcategory name">
                                                        @error('sub_category_icon')
                                                           <small style="color:red">{{ $message }}</small>
                                                        @enderror
                                                   
                                                       <img src="{{asset('public/uploads/subcat_icons/'.$editsubmenu->icon)}}" height="54" width="54" alt="{{$editsubmenu->name}}"/>
                                                  
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                </div>
                                                <div class="form-group col-md-1">
                                                </div>
                                                <div class="form-group col-md-5">

                                                    <button type="submit" class="btn btn-primary"
                                                        style="text-align:left;">Submit</button>
                                                </div>
                                            </div>






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


   

@endsection
