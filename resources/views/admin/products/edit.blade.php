@extends('layouts.admin')
@section('title')
    {{  isset($getProduct) ? 'Update' : 'Add' }}
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{  isset($getProduct) ? 'Update' : 'Add'  }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{  isset($getProduct) ? 'Update' : 'Add'  }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="post"  action='{{ route('admin.product.update') }}' id="myform">
                            @csrf
<<<<<<< HEAD
                            <input type="hidden" name="id" id="menu_id" value="{{ isset($getProduct) ? $getProduct->id : 0  }}" />
=======
                            <input type="hidden" name="id" id="product" value="{{ isset($getProduct) ? $getProduct->id : 0  }}" />
>>>>>>> d23f12eb4618135a0dab52e267510457a8eedc1e
                            <input type="hidden" name="status" value="{{ isset($getProduct) ? $getProduct->status : ''  }}" />
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Handle</label>
                                    <input type="text" name="handle" class="form-control" id="handle" placeholder="handle"
                                        value="{{ isset($getProduct) ? $getProduct->handle : '' }}" required>
                                    @error('handle')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                        value="{{ isset($getProduct) ? $getProduct->title : '' }}" required>
                                    @error('title')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"
                                        value="{{ isset($getProduct) ? $getProduct->slug : '' }}" >
                                    @error('Slug')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body"  class="form-control" required>
                                                {{ isset($getProduct) ? $getProduct->body : '' }}
                                    </textarea>
                                    @error('body')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body">Description</label>
                                    <textarea name="long_description" id="long_description"  class="form-control" required>
                                                {{ isset($getProduct) ? $getProduct->long_description : '' }}
                                    </textarea>
                                    @error('long_description')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vendor</label>
                                    <input type="text" name="vendor" class="form-control" id="vendor" placeholder="Vendor"
                                        value="{{ isset($getProduct) ? $getProduct->vendor : '' }}" required>
                                    @error('vendor')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label>
                                    <input type="text" name="type" class="form-control" id="type" placeholder="Type"
                                        value="{{ isset($getProduct) ? $getProduct->type : '' }}" required>
                                    @error('type')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tags</label>
                                    <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags"
                                        value="{{ isset($getProduct) ? $getProduct->tags : '' }}">
                                    @error('tags')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cms_category">Publish Status</label>
                                        <select name="published" id="published"   class="form-control">
                                            <option value="">--- Select Publish Status ---</option>
                                            <option value="TRUE" {{ isset($getProduct) ? $getProduct->published=='TRUE' ? 'selected' : '' : '' }}>Published</option>
                                            <option value="FALSE" {{ isset($getProduct) ? $getProduct->published=='FALSE' ? 'selected' : '' : '' }}>Not Published</option>
                                        </select>
                                </div>
                                 <?php $attribute_value = json_decode($getProduct->attribute_values); ?>
                                <div class="form-group">
                                    <label for="cms_category">Attribute</label>
                                        <select name="attribute" id="attribute" class="form-control" multiple onchange="get_attribute(this)">
                                            <option disabled value="">--- Select ---</option>
                                            @foreach($attributes as $key=>$attr)
                                            <option name_attr="{{$attr->name}}"  value="{{$attr->id}}">{{$attr->name}}</option>
                                            @endforeach
                                        </select>
                                        <label><a href="#exampleModal" data-toggle="modal" data-target="#exampleModal">View attributes</a></label>
                                </div>
                                <div class ="row" id="attribute_value">
                                    {{-- <div class="form-group col-2">
                                        <input type="text" class="form-control" name="attribute_value" value=""/>
                                    </div> --}}
                               </div>


                                <div class="form-group">
                                    <label for="cms_category">Purchased Status</label>
                                        <select name="is_purchased" id="is_purchased"   class="form-control">
                                            <option value="">--- Select Publish Status ---</option>
                                            <option value="1" {{ isset($getProduct) ? $getProduct->is_purchased=='1' ? 'selected' : '' : '' }}>Purchased</option>
                                            <option value="0" {{ isset($getProduct) ? $getProduct->is_purchased=='0' ? 'selected' : '' : '' }}>Not Purchased</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Attribute<span
                                            style='color:red'>*</span></label>
                                    {{-- <?php  var_dump($getProduct->attribute); 
                                    print_r(json_decode($getProduct->attribute));
                                    ?> --}}
                                            <select type="text" name="attribute[]" class="form-control" id="attribute" required multiple onchange="showattributeform(this)">
                                                <option>Select</option>
                                                @foreach ($attribute as $cats)
                                                @if(json_decode($getProduct->attribute)!=null)
                                                    <option {{ in_array($cats->id, json_decode($getProduct->attribute)) ? 'selected' : '' }} value={{$cats->id}}>{{$cats->name}}</option>
                                                @else
                                                <option  value={{$cats->id}}>{{$cats->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                    @error('attribute')
                                        <small style="color:red">{{ $message }}</small>
                                    @enderror

                                </div>

                               
                                <div class="form-group">
                                    {{-- @if($getProduct->attribute_values!=null)
                                    @foreach (json_decode($getProduct->attribute_values) as $v)
                                    <div class ="row" id="{{$v->attribute_id}}">
                                        <div class ="col-md-6">
                                           <input type ='hidden' name ='ids[]' value='{{$v->attribute_id}}'/>
                                           <label>Value</label> <input type="text" class ="form-control" name="value[]" value="{{$v->value}}" required/>
                                        </div>
                                           <div class ="col-md-6"><label>Unit</label><input type='text' name="unit[]" class ="form-control" size = '6' value="{{$v->unit}}"/></div>
                                       </div>
                                    @endforeach
                                    @endif --}}
                                    <div id ="value_attr"> 
                                       
                                    </div>
                             
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Attributies</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                  <td>Name</td>
                  <td>Value</td>
                  <td>Action</td>
              </tr>
            </thead>
            <tbody id="attr_table">
             
            </tbody>

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>

    <script>
       
        function get_attribute(select)
        {
           // var result = [];
            var options = select && select.options;
            var html = '';
           
            $.each(options,function(index,item){
           
                if(item.selected)
                {
                  let names = $(item).attr('name_attr');
                  html +=  `<div class="form-group col-12">
                                       <input type ="hidden" name ="attribute_id[]" value ="${item.value}"/>
                                      <label>${names}</label>  <input type="text" class="form-control" name="attribute_value[]" value=""/>
                                </div>`
                }
            });
            $('#attribute_value').html(html);
        }
    </script>
    <!-- /.content -->
@endsection
@section('script')

<script type="text/javascript">
let inputfield = [];
    $(document).ready(function() {
        loadattribute()
       //$('.ckeditor').ckeditor();
       CKEDITOR.replace( 'body', {
    filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});

CKEDITOR.replace( 'long_description', {
    filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
    });
   async function loadattribute()
   {
    let product = $("#product").val();
    const response = await $.ajax({
                    url: "{{ route('admin.product.attribute') }}",
                    type: 'get',
                    data: {
                       // "_token": '{{ csrf_token() }}',
                        'product_id': product
                    },
                });
     var html =  ``;
     $.each(response.data,function(index,item){
        html += `<tr>
                <td>${item.name}</td>
                <td>${item.attribute_values}</td>
                <td><a href="${item.url}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
            </tr>`;
     })
     $("#attr_table").html(html);
                console.log(response.data)
   
   }
   
</script>
    <script>
        $(function() {
            $('#myform').validate({
                rules: {
                    title:{
                        required: true
                    },
                    body: {
                        required: true
                    },
                },
                messages: {
                    title:{
                        required: "Please enter a title",
                    },
                    body: {
                        required: "Please enter a body",
                    },
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

        function showattributeform(select)
     {
        
        var html = ``;
        $.each(select.options,function(index,item)
        {
          if(item.selected == true)
          {
             inputfield.push(item.value);
             html +=`<div class ="row">
                        <div class ="col-md-6">
                           <input type ='hidden' name ='ids[]' value='${item.value}'/>
                           <label>Value</label> <input type="text" class ="form-control" name="value[]" required/>
                        </div>
                           <div class ="col-md-6"><label>Unit</label><input type='text' name="unit[]" class ="form-control" size = '6'/></div>
                       </div>`;
          }
        });

    
    </script>
@endsection
