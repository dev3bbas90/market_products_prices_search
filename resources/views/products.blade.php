@extends('layouts')
@section('content')
    <table id="products-table" class="table table-bordered table-hover text-center table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>#</th>
                <th style="width: 30%;">المنتج</th>
                <th>مكانه</th>
                <th>الكمية</th>
                <th>التكلفة</th>
                <th>السعر</th>
                <th style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!--Start Product Modal-->
        <div class="modal" id="ProductModal"  tabindex="-1" role="dialog">
            <div class="modal-dialog mw-100 w-75">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="la la-edit"></i>
                            <span id="modal-title">إضافة منتج جديد</span>
                        </h4>
                    </div>

                    <form action="{{ route('products.store') }}" method="post" id="ProductForm" class="form-horizontal" role="form">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id" value="" />
                            <div class="row ">

                                <div class="form-group col-6">
                                    <label class="col-form-label text-left">إسم المنتج</label>
                                    <input type="text" name="name" id="name" value="" class="form-control" placeholder="إسم المنتج">
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-form-label text-left">مكانه</label>
                                    <input type="text" name="location" id="location" value="" class="form-control" placeholder="مكانه">
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-form-label text-left">التكلفة</label>
                                    <input type="number" name="cost" step="0.10" id="cost" value="0" class="form-control" placeholder="التكلفة">
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-form-label text-left">سعر البيع</label>
                                    <input type="number" name="price" step="0.10" id="price" value="" class="form-control" placeholder="سعر البيع">
                                </div>

                                <div class="form-group col-6">
                                    <label class="col-form-label text-left">الكمية</label>
                                    <input type="number" name="quantity" id="quantity" value="0" class="form-control" placeholder="الكمية">
                                </div>

                            </div>
                        </div>
                        <div class = "modal-footer">
                            <button type="submit" class="btn btn-primary font-weight-bold px-5" >حـفـظ</button>
                            <input type="button" value="إلغاء" class="btn btn-danger mx-3  btn-sm blue-steel margin-left-10 px-2" data-dismiss="modal"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!--end ProductModal Modal-->
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>


    <script>
        var table;
        function initDatatable(url)
        {
            return $('#products-table').DataTable({
                processing: true,
                responsive: true,// اكتبوا السطر دا فى كل الجداول اذا تكرمتم
                serverSide: true,
                ajax:
                {
                    url    : url,
                    type   : 'GET',
                },
                order      : [[2, 'desc']],
                lengthMenu : [ [10,20, 30, 40,50], [10,20, 30, 40,50] ],
                pageLength : 10,
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                buttons: [
                    'excel'
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [],
                columns:
                [
                    {
                        data      : "id",
                        name      : "id"
                    },
                    {
                        data      : "name",
                        name      : "name"
                    },
                    {
                        data      : "location",
                        name      : "location"
                    },
                    {
                        data      : "quantity",
                        name      : "quantity"
                    },
                    {
                        data      : "cost",
                        name      : "cost"
                    },
                    {
                        data      : "price",
                        name      : "price"
                    },

                    {
                        data   : null, orderable: false, searchable: false, render: function (data, type, row)
                        {
                            var $back       = '';
                            var delete_url  = "{{url('')}}/Products/destroy/"+data.id+"";
                            $back           += '<button onclick="product('+data.id+')" data-toggle="modal" data-target="#ProductModal" class="btn btn-primary font-weight-bold m-1 p-1" data-container="body" data-toggle="tooltip" data-placement="top" title="تعديل"><i class="fa fa-edit pr-1"></i> </button>';
                            $back           += '<button class="btn btn-danger font-weight-bold mr-2 p-1" onClick="deleteDataT_custom(`'+ delete_url +'` , ' + data.id + ' , `products-table`)"><i class="fa fa-trash pr-1" ></i> </button>';
                            return $back;
                        }
                    },

                ]
            });
        }
        $(document).ready(function(){
            setTimeout(function()
            {
                table = initDatatable("{{route('products.data')}}");
            }, 1000);
        });

        function deleteDataT_custom( url , id , table )
        {
            Swal.fire({
                title: "هل متأكد",
                text: "سيتم حذف المنتج",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> " + "نعم",
                cancelButtonText: "<i class='fa fa-times'></i> " +"لا",
                reverseButtons: true,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-success"
                }
            }).then(function(result) {
                if (result.value)
                {
                    $.ajax({
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.status)
                            {
                                Swal.fire(
                                    "بنجاح!!",
                                    "تم الحذف بنجاح",
                                    "success"
                                );
                                $('#' + table ).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (data) {
                            Swal.fire(
                                lang2.fail + "!!",
                                data.message,
                                "error"
                            );
                        },
                        dataType: "json",
                        type: 'Delete'
                    });
                }
                else if (result.dismiss === "cancel")
                {
                    Swal.fire(
                        "Cancelled !!",
                        "",
                        "info"
                    )
                    return false;
                }
            });
        }


        let btn = '<a onClick="product(0)" data-toggle="modal" data-target="#ProductModal" class="btn btn-success py-1 pt-2 font-weight-bolder mr-2 ">';
            btn = btn + '<span class="svg-icon svg-icon-md"> <i class="icon fas fa-plus"></i> </span>';
            btn = btn + 'إضافة منتج </a>';
        setTimeout(() => {
            console.log('Here');
            $('#products-table_wrapper').children(":first").children().eq(0).removeClass('col-sm-6').addClass('col-sm-9');
            $('#products-table_wrapper').children(":first").children().eq(1).removeClass('col-sm-6').addClass('col-sm-3 text-center');
            $('#products-table_wrapper').children(":first").children().eq(1).append(btn);
        }, 2000);

        function product(id)
        {
            $('#name').val('');
            $('#location').val('');
            $('#quantity').val('');
            $('#cost').val(0);
            $('#price').val('');
            $('#product_id').val(id);
            if(id == 0)
            {
                $('#modal-title').html('إضافة منتج جديد');
                $('#ProductForm').prop('action' , "{{ route('products.store') }}");
            }
            else
            {
                $('#modal-title').html('تعديل المنتج');
                $('#ProductForm').prop('action' , "{{ route('products.update') }}");
                // get product details
                $.ajax({
                    type: "GET",
                    url: "{{ route('products.edit' , 0) }}" + id,
                    success: function(product)
                    {
                        $('#name').val(product.name);
                        $('#location').val(product.location);
                        $('#quantity').val(product.quantity);
                        $('#cost').val(product.cost);
                        $('#price').val(product.price);
                    }
                });
            }
            setTimeout(function(){$('#name').focus();},400);
        }

        $('form').submit(function(event) {
            event.preventDefault();
            var thisForm = $(this);
            var formAction = thisForm.attr('action');
            var formMethod = thisForm.attr('method');
            var formData = new FormData(this);
            $.ajax({
                url: formAction,
                type: formMethod,
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if(data.status)
                    {
                        $('#ProductModal').modal('hide');
                        Swal.fire(
                            "نجاح !!",
                            data.message,
                            "success"
                        );
                        $('#products-table').DataTable().ajax.reload(null, false);
                    }
                    else
                    {
                        Swal.fire(
                            "خطأ !!",
                            data.message,
                            "error"
                        );
                    }
                    // $('#ProductModal').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
                    Swal.fire(
                        "خطأ !!",
                        errorThrown,
                        "error"
                    );
                }
            });
        });
    </script>
@endsection
