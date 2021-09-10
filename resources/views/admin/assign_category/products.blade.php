@extends('layouts.admin')
@section('content')
@section('title')
    Products
@endsection
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Category</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                     {{--<div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3> 
                    </div>--}}
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body">
                       <!--  <label><a href="{{ route('admin.product.add') }}" class="btn btn-success">Add</a></label>
                        <label><a href="{{ route('admin.products.export') }}" class="btn btn-info">Export</a></label> -->
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Name</th>
                                    <th>Attribute</th>
                                    <th>color</th>
                                    <th>Category</th>
                                    <th>Shape</th>
                                    <th>Size</th>
                                    <th>Gift</th>
                                   
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>
                            </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- large modal -->
<div class="modal fade" id="addattribute_value" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="attribute">
        @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Attributes</h4><h4 id ="countattr">(0)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
       <div class ="row">
        <div class ="col-md-12">
            <input type="hidden" name="product_id" id ="product_id" value=""/>
            <select class ="form-control" id ="attributes" multiple onchange="showattributeform(this)">
                
            </select>
        </div>
          
       </div>
       <div id ="value_attr">
           

       </div>

       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="submitattributevalue()" class="btn btn-primary">Save</button>
      </div>
    </div>
</form>
  </div>
</div>
@endsection
@section('script')
<script>
    const method = (function()
    {
         async function sizes(id,size)
         {
            console.log(size)
           let result = await $.ajax({
                  url:"{{route('admin.product.updatesize')}}",
                  type:"Post",
                  data:{
                    "_token": '{{ csrf_token() }}',
                    "product_id":id,
                    "size":size
                  }

              });
           if(result.stat == true)
           {
               $.toast({
                        heading: 'success',
                        text: result.message,
                        icon: 'success',
                        position: 'top-right'
                }); 
           }
            
          }

             async function gifts(gift,id)
             {
               let result = await $.ajax({
                      url:"{{route('admin.product.updateaddgift')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":id,
                        "gift":gift
                      }

                  });
               if(result.stat == true)
               {
                   $.toast({
                            heading: 'success',
                            text: result.message,
                            icon: 'success',
                            position: 'top-right'
                    }); 
               }
                
              }

             async function shape(shape,id)
             {
               let result = await $.ajax({
                      url:"{{route('admin.product.updateshape')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":id,
                        "shape":shape
                      }

                  });
               if(result.stat == true)
               {
                   $.toast({
                            heading: 'success',
                            text: result.message,
                            icon: 'success',
                            position: 'top-right'
                    }); 
               }
                
              }


            async function category(cat_id,id)
             {
               let result = await $.ajax({
                      url:"{{route('admin.product.updatecategory')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":id,
                        "cat_id":cat_id
                      }

                  });
               if(result.stat == true)
               {
                   $.toast({
                            heading: 'success',
                            text: result.message,
                            icon: 'success',
                            position: 'top-right'
                    }); 
               }
                
              }

             async function colors(color,id)
             {
               let result = await $.ajax({
                      url:"{{route('admin.product.colorupdate')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":id,
                        "color":color
                      }

                  });
               if(result.stat == true)
               {
                   $.toast({
                            heading: 'success',
                            text: result.message,
                            icon: 'success',
                            position: 'top-right'
                    }); 
               }
                
              }
              
              async function updateattribute(sel,id)
              {
                var opts = [],opt;
                var len = sel.options.length;
                for (var i = 0; i < len; i++) {
                opt = sel.options[i];

                if (opt.selected) 
                {
                  opts.push(opt.value);
                }
              }
              
              let result = await $.ajax({
                      url:"{{route('admin.product.attributeupdate')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":id,
                        "attribute":opts
                      }

                  });
               if(result.stat == true)
               {
                   $.toast({
                            heading: 'success',
                            text: result.message,
                            icon: 'success',
                            position: 'top-right'
                    }); 
                 //  setTimeout(function(){ location.reload() }, 2000);
               }
                
              }

             async function addattributevalue(product_id) 
             {
              
               try
               {
                $("#product_id").val(product_id);
                 let result = await $.ajax({
                      url:"{{route('admin.attributeupdate.product')}}",
                      type:"Post",
                      data:{
                        "_token": '{{ csrf_token() }}',
                        "product_id":product_id,
                        
                      }

                  });
                 
                 var html = "<option selected disabled value=''>--Select--</option>";
                 $.each(result.data.attribut,function(index,item){
                    html += '<option value='+item['id']+'>'+item['name']+'</option>'
                 });
                 $('#attributes').html(html)

                 $('#addattribute_value').modal('show');
               }
               catch(error)
               {
                console.log(error)
               }
                 
                 }
                  
              

            
         return {
            sizes:sizes,
            gifts:gifts,
            shape:shape,
            category:category,
            colors:colors,
            updateattribute:updateattribute,
            addattributevalue:addattributevalue,
            showattributeform:showattributeform
           
           
         }
    })();
     function showattributeform(select)
     {
       
        let inputfield = [];
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
        $("#countattr").text("("+inputfield.length+")");
        $("#value_attr").html(html);
       
     }
     async function submitattributevalue()
     {
       let form = $("#attribute").serializeArray();
       let result = await $.ajax({
                      url:"{{route('admin.attributeupdate.save')}}",
                      type:"Post",
                      data:form

                  });
       if(result.stat == true)
       {
         $.toast({
                    heading: 'success',
                    text: result.message,
                    icon: 'success',
                    position:'top-right'
                    }); 
        setTimeout(function(){
            location.reload();}, 3000);
       }
     }
         
    
    function ispublished(id,status) 
    {
        console.log(status);
         let url = "{{ url('admin/product/published/status') }}" + "/" + id+"/"+status;
        $.ajax({
                url: url,
                type: 'get',
                datatype: 'JSON'
            })
            .done(function(data) {
                $("#published_"+id).text(data);
                location.reload(true);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log('error');

            });
    }
    $(function() {
        $(document).ready(function() {
            $('#example2').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "ajax": {
                    "url": "{{ route('admin.product.assign') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "SL"
                    },
                    {
                        "data": "title"
                    },
                    {
                        "data": "attribute"
                    },
                    {
                        "data": "color"
                    },
                    {
                        "data": "category"
                    },
                     {
                        "data": "shape"
                    },
                    {
                        "data": "size"
                    },
                    {
                        "data": "gift"
                    }
                   
                ]

            });
        });
    });
</script>
@endsection
