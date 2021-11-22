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
                                <h2 class="text-white font-weight-bold my-2 mr-5">Inventory</h2>
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
                                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Available</a>
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
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">Inventory</h3>
                            </div>
                            <!--begin::Form-->
                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>OS</th>
                                        <th>Manufacturer</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inventories as $inventory)
                                        <tr>
                                            <td>{{$inventory->id}}</td>
                                            <td>{{$inventory->code}}</td>
                                            <td>{{$inventory->name}}</td>
                                            <td>{{$inventory->os}}</td>
                                            <td>{{$inventory->manufacturer}}</td>
                                            <td>{{$inventory->quantity}}</td>
                                            <td>{{$inventory->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--end: Datatable-->
                            </div>
                        </div>
                        <!--end::Card-->
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
    {{--<script src="{{asset('pull-table.js?v=7.0.5')}}"></script>--}}
    <script>
        $('#kt_datatable').DataTable({
            responsive: true,
            paging: true,
            headerCallback: function(thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                    <label class="checkbox checkbox-single">
                        <input type="checkbox" value="" class="group-checkable"/>
                        <span></span>
                    </label>`;
            },

            columnDefs: [
                {
                    targets: 0,
                    width: '30px',
                    className: 'dt-left',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `
                        <label class="checkbox checkbox-single">
                            <input type="checkbox" value="" class="checkable"/>
                            <span></span>
                        </label>`;
                    },
                }],
        }).on('change', '.group-checkable', function() {
            var set = $(this).closest('table').find('td:first-child .checkable');
            var checked = $(this).is(':checked');

            $(set).each(function() {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                }
                else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        table.on('change', 'tbody tr .checkbox', function() {
            $(this).parents('tr').toggleClass('active');
        });
    </script>
@endpush
