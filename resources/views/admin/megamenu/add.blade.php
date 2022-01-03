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
                        <li class="breadcrumb-item"><a href="javascript:void(0);"></a></li>Add Mega Menu Category</a></li>
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

                                <form id="myform" action='{{ route('admin.megamenu.category.save') }}' method="POST"
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

                                                    <select name="menu_subcategory_id" class="form-control" id="menu_id" >
                                                        <option value="">--select--</option>
                                                        @foreach ($menu as $menus)
                                                            <option value="{{$menus->id}}">{{$menus->name}}</option>
                                                        @endforeach
                                                       
                                                    </select>
                                                    @error('menu_subcategory_id')
                                                      <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="row" >
                                                <div class="form-group col-md-4">
                                                </div>
                                              
                                                <div class="form-group col-md-4 type" style ="display: none">
                                                    <label for="name">{{ __(' Sub Categories ') }}</label>
                                                    <select class="form-control" name="sub_menu_id" id="types" >
                                                        <option value="">--select--</option>
                                                        @foreach($submenu as $submenues)
                                                          <option value ='{{$submenues->id}}'>{{$submenues->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub_menu_id')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
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
        // $(".type").change(function(){
        //     let value = $('#types').val();
        //     if(value == 'mega')
        //     {
        //        $("#mega_menu_sub").css('display','block');
        //        $("#sub_cat").css('display','none');
        //        $("#menu_product_icon").css('display','none');
        //     }
        //     else
        //     {
        //       $("#mega_menu_sub").css('display','none');
        //       $("#sub_cat").css('display','block');
        //       $("#menu_product_icon").css('display','block');
            
        //     }
        // })
    })
</script>
   
@endsection
