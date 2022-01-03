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
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Menu</a></li>
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
                    <div class ="row" style="margin-bottom: 2%">
                       <div class="col-md-6">
                         <label>Menu</label>
                        <select class="form-control" id="menu_id" onchange="chosemenu(this.value)">
                          <option value="" selected disabled>Select</option>
                          @foreach ($menus as $key=>$item)
                            <option value="{{$item->id}}">{{$item->menu_name}}&nbsp;&nbsp;<strong>(Main Menu)</strong></option>
                            @foreach ($item->submenus as $subs)
                              @if($subs->mega_parent_id == 0)
                            <option value="{{$subs->id}}">{{$subs->name}}&nbsp;&nbsp;<strong>(Mega Menu)</strong></option>
                            @else
                            <option value="{{$subs->id}}">{{$subs->name}}&nbsp;&nbsp;<strong>(Sub menu)</strong></option>
                            @endif
                            @endforeach
                          @endforeach
                        </select>
                      </div>

                      {{-- <div class="col-md-6">
                        <label>Sub Menu</label>
                       <select class="form-control" id="sub_menu">
                         <option disabled>Select</option>
                       </select>
                     </div> --}}
                     <div class="col-md-6">
                      <button type="button" onclick="update()" class="btn btn-success" style="margin-top: 2%">Add</button>
                    </div>
                    </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Name</th>
                                    <th>Menu</th>
                                    <th>Sub Menu</th>
                                    <th>Image</th>
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
    // 
    $(function() {
        $(document).ready(function() {
            $('#example2').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthChange": false,
                "ajax": {
                    "url": "{{ route('assign.product.menu.list') }}",
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
                        "data": "menu"
                    },
                    {
                        "data": "sub_menu"
                    },
                    {
                        "data": "Image"
                    },
                   
                   
                ]

            });
        });
    });
  //  async function chosemenu(id)
  //  {
  //   try{
  //     let response = await $.ajax({
  //      url:"{{route('assign.product.subcategory')}}",
  //      type:"get",
  //      data:{
       
  //       "id":id
  //      }
  //    });
  //   // console.log(response.data)
  //   var html = '';
  //    html +=`<option value=''selected >Select</option>`;
  //    $.each(response.data,function(index,item){
      
  //       html +=`<option value ='${item.id}'>${item.name}</option>`
  //    });
  //   $("#sub_menu").html(html);
    
  //   }
  //   catch(error){
  //     console.log(error);
  //   }
     
     
  //  }
   async function update()
   {
     var menu_id = $("#menu_id").val();
     var sub_menu = $("#sub_menu").val();
     let product_ids = [];

     $(".menu_item:checked").each(function(index,item){
       product_ids[index] = item.value;
     });
    try
    {
          let result = await $.ajax({
          url: "{{ route('assign.menu.products') }}",
          type: 'post',
          data: {
              "_token": '{{ csrf_token() }}',
              'product_ids': product_ids,
              'menu_id':menu_id,
              'sub_menu':sub_menu
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
              location.reload();
          }
          else
          {
            $.toast({
                    heading: 'error',
                    text: result.message,
                    icon: 'error',
                    position: 'top-right'
                });
          }
        
        
    } 
    catch(error)
    {
      console.log(error)
    }

   

   }
</script>
@endsection
