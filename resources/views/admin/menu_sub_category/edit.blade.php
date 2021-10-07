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

                                <form id="myform" action='{{ route('admin.productSubCategory.save') }}' method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='id'
                                        value="{{ isset($getMenu) ? $getMenu->product_sub_category_id : 0 }}" />
                                    <div class="bs-stepper-content">
                                        <!-- your steps content here -->
                                        <div id="logins-part" class="content" role="tabpanel"
                                            aria-labelledby="logins-part-trigger">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                {{-- <?php print_r($getMenu); ?> --}}

                                                <div class="form-group col-md-4">
                                                    <label for="menu">MENU</label>

                                                    <select name="menu_id" class="form-control dynamic" id="menu_id">
                                                        @if (empty($getMenu))
                                                            <option value=" ">--- Select Menu ---</option>
                                                        @endif
                                                        @foreach ($menu as $my)

                                                            <option value="<?php echo $my->id; ?>" <?php if (!empty($getMenu)) {
    echo $getMenu->menu_id == $my->id ? 'selected' : '';
} ?>>
                                                                {{ $my->menu_name }} </option>
                                                        @endforeach
                                                    </select>



                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4"  id="menu_category">
                                                    <label for="menu">MENU CATEGORY </label>

                                                    {{-- <select name="product_category_id" class="form-control " id="undercat">
                                                        <option value=" ">Select Category</option>
                                                    </select> --}}

                                                    <select name="product_category_id" class="form-control dynamic" id="undercat">
                                                        @if (empty($getMenu))
                                                            <option value=" ">--- Select Menu ---</option>
                                                        @endif
                                                        @foreach ($category as $cat)

                                                            <option value="<?php echo $cat->product_category_id; ?>" <?php if (!empty($getMenu)) {
    echo $getMenu->product_category_id == $cat->product_category_id ? 'selected' : '';
} ?>>
                                                                {{ $cat->product_category }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>
                                                <div class="form-group col-md-4" 
                                                    id="menu_product_category">

                                                    <label for="name">{{ __(' SUB CATEGORY NAME ') }} <span
                                                            style='color:red'>*</span></label>  
                                                    <input type="text" name="sub_category_name" class="form-control"
                                                        id="exampleInputEmail1" placeholder=" subcategory name"  value="<?php echo !empty($getMenu)? $getMenu->sub_category_name:'' ?>" required>
                                                    @error('menu')
                                                        <small style="color:red">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                </div>

                                                <div class="form-group col-md-4" 
                                                    id="menu_product_icon">
                                                    <input type="hidden" name="hidden_file" value="<?php echo !empty($getMenu)? $getMenu->icon:'' ?>" />

                                                    <label for="name">{{ __(' SUB CATEGORY ICON ') }}(15 x 15) @if (!empty($getMenu))
                                                        {{$getMenu->icon}}
                                                     @endif</label>
                                                    <input type="file" name="sub_category_icon" class="form-control"
                                                        placeholder=" subcategory name">
                                                    @error('menu')
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
        $(document).ready(function() {

            $('.dynamic').change(function() {

                var select = $(this).attr("id");

                var menu_id = $(this).val();

                //   $.get('ajaxdata?cat_id=' + cat_id, function(data){
                // //console.log(data);
                // $('#undercat').empty();
                // $.each(data, function(index, subcat){
                // $('#undercat').append('<option value="'+subcat.product_name_id'">'+subcat.product_name+'</option>')

                // });
                //  });
                $.ajax({
                    url: "{{ url('admin/menudata') }}",
                    method: 'get',
                    data: {
                        menu_id: menu_id

                    },

                    success: function(data) {
                        // var perform= data.changedone;

                      


                        $('#undercat').empty();

                        console.log(data)
                        let html = '';
                        for (var i = 0; i < data.length; i++) {
                            console.log(data[i].product_category)
                            html +=
                                `<option value="${data[i].product_category_id}">${data[i].product_category}${data[i].mega_menu==1? '(MEGA MENU)': ''}</option> `;

                        }

                        $('#undercat').html(
                            `<option value="">--Select Category -----</option>${html}`);
                        //  alert(perform.product_name);
                        // jQuery('.alert').html(result.success);
                    }

                });



            });



        });
    </script>

@endsection
