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

                                <form id="myform" action='{{ route('admin.saveSubcategory.save') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- <input type="hidden" name='id'
                                        value="{{ isset($getMenu) ? $getMenu->product_category_id : 0 }}" /> --}}
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label for="menu">MENU</label>

                                                    <select name="menu_id" class="form-control dynamic" id="menu_id" >
                                                        <option value="">--select--</option>
                                                        @foreach ($menu as $menus)
                                                            <option value="{{$menus->id}}">{{$menus->menu_name}}</option>
                                                        @endforeach
                                                       
                                                    </select>
                                                    @error('menu_id')
                                                      <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="row" >
                                                <div class="form-group col-md-4">
                                                </div>
                                              
                                                <div class="form-group col-md-4 type" style ="display: none">
                                                    <label for="name">{{ __(' Category Type ') }}</label>
                                                    <select class="form-control" name="types" id="types" >
                                                        <option value="">--select--</option>
                                                        <option value ='mega'>Mega menu Category</option>
                                                        <option value = 'sub'>Sub Category</option>
                                                    </select>
                                                    @error('types')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>
                                                <div class="form-group col-md-4" 
                                                    id="sub_cat" style="display: none">

                                                    <label for="name">{{ __(' SUB CATEGORY ') }} <span
                                                            style='color:red'>*</span></label>
                                                    <input type="text" name="sub_category_name" class="form-control"
                                                        id="exampleInputEmail1" placeholder="SUB CATEGORY" >
                                                    @error('sub_category_name')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>
                                                <div class="form-group col-md-4" 
                                                    id="mega_menu_sub" style="display: none">

                                                    <label for="name">{{ __(' MEGA MENU CATEGORY ') }} <span
                                                            style='color:red'>*</span></label>
                                                    <input type="text" name="mega_menu_cat" class="form-control"
                                                        id="exampleInputEmail1" placeholder="MEGA MENU CATEGORY NAME" >
                                                    @error('mega_menu_cat')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4" style="display:none;"
                                                    id="menu_product_icon">

                                                    <label for="name">{{ __(' SUB CATEGORY ICON ') }}(15 x 15)</label>
                                                    <input type="file" name="sub_category_icon" class="form-control"
                                                        placeholder="subcategory name" />
                                                    @error('sub_category_icon')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4" style="display:none;"
                                                    id="banner_image">

                                                    <label for="name">{{ __(' Banner Image ') }}</label>
                                                    <input type="file" name="banner_image" class="form-control"
                                                        placeholder="subcategory name" />
                                                    @error('banner_image')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>
                                                <div class="form-group col-md-4" 
                                                    id="description" style="display: none">

                                                    <label for="name">{{ __(' Description ') }} </label>
                                                    <textarea type="text" name="description" class="form-control" >
                                                    </textarea>
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

<script>
    $(document).ready(function(){
       
        $("#menu_id").change(function(){
            $(".type").css("display", "block");
        });
        $(".type").change(function(){
            let value = $('#types').val();
            if(value == 'mega')
            {
               $("#mega_menu_sub").css('display','block');
               $("#banner_image").css('display','block');
               $("#description").css('display','block');
               $("#sub_cat").css('display','none');
               $("#menu_product_icon").css('display','none');
            }
            else
            {
              $("#mega_menu_sub").css('display','none');
              $("#banner_image").css('display','block');
               $("#description").css('display','block');
              $("#sub_cat").css('display','block');
              $("#menu_product_icon").css('display','block');
            
            }
        })
    })
</script>
   
@endsection
