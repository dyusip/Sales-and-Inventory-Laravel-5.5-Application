@extends('layout.app'){{--layout--}}
@section('content');
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
        @include('layout.header'){{--header navigation--}}
        <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h2 class="text-white font-weight-bold my-2 mr-5">Create Sales Order</h2>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <div class="d-flex align-items-center font-weight-bold my-2">
                                    <!--begin::Item-->
                                    <a href="#" class="opacity-75 hover-opacity-100">
                                        <i class="flaticon2-shelter text-white icon-1x"></i>
                                    </a>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Create Sales Order</a>
                                    <!--end::Item-->
                                </div>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        {{--sales form--}}
                        <form action="/sales" method="post" id="myform">
                        <div class="row">
                            <div class="col-md-12">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header">
                                        <h3 class="card-title">Sales Info</h3>
                                    </div>
                                    <!--begin::Form-->
                                    <div class="card-body">
                                            {{ csrf_field() }}
                                            <div class="card-body">
                                                @if (session('status'))
                                                    <div class="alert alert-success mb-5 p-5" role="alert">
                                                        <h4 class="alert-heading">Well done!</h4>
                                                        <p>{{ session('status') }}</p>
                                                    </div>
                                                @endif
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label>Order #:</label>
                                                            <input type="text" name="sh_no" id="sh_no" readonly value="{{$order_no}}" class="form-control form-control-solid" placeholder="Order #">
                                                            <span class="form-text text-muted">Auto generated order #</span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Date</label>
                                                            <input class="form-control" type="date" name="date" value="{{date('Y-m-d')}}" id="example-date-input">
                                                            <span class="form-text text-muted">Please enter the date of transaction</span>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                </div>
                                {{--end card--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header">
                                        <h3 class="card-title">Item List</h3>
                                    </div>
                                    <!--begin::Form-->
                                    <div class="card-body">
                                        <!--begin: Datatable-->
                                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                            <thead>
                                            <tr>
                                                <th width="10%">Code</th>
                                                <th width="25%">Name</th>
                                                <th>OS</th>
                                                <th width="10%">AV</th>
                                                <th width="10%">Qty</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th class="text-center"><a data-toggle="tooltip" href="javascript:;" class="btn btn-sm btn-clean btn-icon add-row" title="Add More Item"><i class="flaticon2-plus-1 text-primary"></i></a></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-control form-control-sm form-control-solid code" readonly type="text" id="prod_code">
                                                    <input required class="form-control form-control-sm form-control-solid code" readonly type="hidden" name="prod_name[]" id="prod_name">
                                                </td>
                                                <td><select required class="form-control form-control-sm form-control-solid select2 product" name="product[]">
                                                        <option value=""></option>
                                                        @foreach($inventories as $inventory)
                                                            <option value="{{$inventory->code}}">{{$inventory->name}} - {{$inventory->manufacturer}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required class="form-control form-control-sm form-control-solid" readonly type="text" name="prod_os[]" id="prod_os"></td>
                                                <td><input required class="form-control form-control-sm form-control-solid" readonly type="text" id="available"></td>
                                                <td><input required class="form-control form-control-sm" type="text" name="prod_qty[]" id="prod_qty"></td>
                                                <td><input required class="form-control form-control-sm form-control-solid" readonly type="text" name="prod_price[]" id="prod_price"></td>
                                                <td><input required class="form-control form-control-sm form-control-solid amount" readonly type="text" name="amount[]" id="amount"></td>
                                                <td class="text-center"><a href="javascript:;" id="remove-row" data-toggle="tooltip" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-trash text-danger"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-group row">
                                            <div class="col-lg-4 offset-8">
                                                <label>Total Amount</label>
                                                <input type="text" readonly class="form-control form-control-solid" name="totalAmount" id="totalAmount" placeholder="Total Amount">
                                            </div>
                                        </div>
                                        <!--end: Datatable-->
                                        <div class="card-footer">
                                            <button type="submit" id="btn-submit" class="btn btn-primary mr-2">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card-->
                            </div>
                            {{--end col--}}
                        </div>
                        {{--end row--}}
                        </form>
                        {{--endform--}}
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
        @include('layout.footer')
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
@endsection
@push('styles')
    {{--<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />

@endpush
@push('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.5')}}"></script>
    <script>
        //initialize scripts
        $(document).ready(function () {
            Choosen();
            Validate();
        });
        //datatables
        $('#kt_datatable').DataTable({
            responsive: true,
            paging: true,
            sort: false,
        });
        //select2
        function Choosen()
        {
            $('.select2').select2({
                placeholder: "Select a product"
            });
        }
        //Validate Quantity input if numeric
        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;
            var keychar = String.fromCharCode(key);
            if (event.keyCode == 8 || event.keyCode == 46
                || event.keyCode == 37 || event.keyCode == 39) {
                return true;
            }
            else if ( key < 48 || key > 57 || keychar==".") {
                return false;
            }
            else return true;
        }
        function Validate() {
            $('[id^=prod_qty]').keypress(validateNumber);
        }

        //Select Product
        $('tbody').delegate('.product','change',function () {
            var tr = $(this).parent().parent();//get the row being touch
            var product = $(this).val();
            $('.code').each(function (i,e) {
                if(product===$(this).val()){//check if item already exist
                    toastr.error("Item already from the list(s)");
                    tr.find('input').val('');
                    tr.find('.select2-selection__rendered').html('<span class="select2-selection__placeholder">Select a product</span>');
                    tr.find('.product').val('');
                    totalAmount();
                    throw "exit";
                }
            });//end of checking item existing
            $.ajax({
                url: "/sales/"+product,
                beforeSend: function() {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        opacity: 0.3,
                        state: 'primary',
                        message: 'Processing...',
                    });// processing page
                },
                success: function (data) {
                    tr.find('#prod_code').val(data.code);
                    tr.find('#prod_name').val(data.name);
                    tr.find('#prod_os').val(data.os);
                    tr.find('#available').val(data.quantity);
                    tr.find('#prod_price').val(data.price);
                    KTApp.unblockPage();//remove processing page
                }
            });
        });

        //end of Table function
        $('tbody').delegate('#prod_qty','keyup',function () {
            var tr = $(this).parent().parent();

            var qty = $(this).val();//input
            var price = tr.find('#prod_price').val();//price
            var available = tr.find('#available').val();//item qty availabilty
            if(Number(qty)>Number(available)){
                toastr.error("Quantity order should not exceeds available");
                tr.find('#amount').val(0);
                tr.find('#prod_qty').val('');
                totalAmount();
            }else{
                var amount = price * qty;
                tr.find('#amount').val(amount.toFixed(2));
                totalAmount();
            }

        });
        //compute total amount
        function totalAmount() {
            var total = 0;//totalAmount
            $('.amount').each(function (i,e) {
                var amount = $(this).val()-0;
                total += amount;
            });
            $('#totalAmount').val(total.toFixed(2))
        }

        //Add New Item
        function addRow() {
            var row  = "<tr>\n" +
                "<td><input class=\"form-control form-control-sm form-control-solid code\" readonly type=\"text\" id=\"prod_code\">\n" +
                "<input required class=\"form-control form-control-sm form-control-solid code\" readonly type=\"hidden\" name=\"prod_name[]\" id=\"prod_name\"></td>\n" +
                "<td><select required class=\"form-control form-control-sm form-control-solid select2 product\"  name=\"product[]\">\n" +
                "<option value=\"\"></option>\n" +
                "@foreach($inventories as $inventory)\n" +
                "<option value=\"{{$inventory->code}}\">{{$inventory->name}} - {{$inventory->manufacturer}}</option>\n" +
                "@endforeach\n" +
                "</select>\n" +
                "</td>\n" +
                "<td><input required class=\"form-control form-control-sm form-control-solid\" readonly type=\"text\" name=\"prod_os[]\" id=\"prod_os\"></td>\n" +
                "<td><input class=\"form-control form-control-sm form-control-solid\" readonly type=\"text\" id=\"available\"></td>\n" +
                "<td><input required class=\"form-control form-control-sm\" type=\"text\" name=\"prod_qty[]\" id=\"prod_qty\"></td>\n" +
                "<td><input required class=\"form-control form-control-sm form-control-solid\" readonly type=\"text\" name=\"prod_price[]\" id=\"prod_price\"></td>\n" +
                "<td><input required class=\"form-control form-control-sm form-control-solid amount\" readonly type=\"text\" name=\"amount[]\" id=\"amount\"></td>\n" +
                "<td class=\"text-center\"><a href=\"javascript:;\" id='remove-row'' data-toggle=\"tooltip\" class=\"btn btn-sm btn-clean btn-icon\" title=\"Delete\"><i class=\"la la-trash text-danger\"></i></a></td>\n" +
                "</tr>";
            $('tbody').append(row);
        }
        //Add More Item Button
        $('.add-row').on('click',function () {
            addRow();
            Choosen();
            Validate();
        });
        //remove item
        $('body').delegate('#remove-row','click',function () {
            var tr = $('tbody tr').length;
            if(tr > 1){
                $(this).parent().parent().remove();
                $('.tooltip').hide();
                totalAmount();
            }else{
                toastr.error('Unable to remove the first field');
            }
        });
    </script>
@endpush
