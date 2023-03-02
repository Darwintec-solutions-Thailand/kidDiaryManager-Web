@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    {{-- for sweetalert2 --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    {{-- for sweetalert2 --}}
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('content')
    <h4>ข้อมูลกลุ่มอายุ</h4>

    <div class="card">

        {{-- Button เพิ่มลบข้อมูล --}}
        <div class="d-flex m-2">
            <div class="m-2"> <button type="button" class="btn btn-primary waves-effect waves-light btnAddData">
                    <i class="tf-icons ti ti-plus"></i> เพิ่มข้อมูล
                </button></div>

            <div class="m-2">
                <button type="button" class="btn btn-instagram waves-effect waves-light" id="btnDeleteAll">
                    <i class="tf-icons ti ti-trash"></i> ลบข้อมูลที่เลือก
                </button>
            </div>
        </div>

        {{-- ตารางข้อมูล --}}
        <div class="card-datatable table-responsive">
            <pre id="example-console-rows"></pre>
            <table class="tb_AnalysisGrowthChartSrc table">
                <thead>
                    <tr>
                        <th></th>
                        <th>ลำดับ</th>
                        <th>คำอธิบาย EN</th>
                        <th>คำอธิบาย TH</th>
                        <th>OWNER</th>
                        <th>action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

    {{-- modalStoreData --}}
    @include('content.pages.AnalysisGrowthChartSrc.modalStoreData')

    {{-- modalPreView --}}
    @include('content.pages.AnalysisGrowthChartSrc.modalPreView')

    @CSRF
@endsection

@section('page-script')

    <script>
        $(document).ready(function() {

            //token เอาไว้เรียก Ajax
            var _token = $('input[name="_token"]').val();

            //ปุ่มเพิ่มข้อมูล
            $('.btnAddData').click(function() {
                const type = $('#modalType').val('');
                const title = $('#title').val('')
                const ageMin = $('#ageMin').val('')
                const ageMax = $('#ageMax').val('')
                $('#modalStoreData').modal('show');
                $('#modalCenterTitle').text('เพิ่มข้อมูล');
            })

            //ปุ่ม Modal เพิ่มข้อมูล
            $('.btnSave').click(function() {

                //รับค่าจาก input
                const modalType = $('#modalType').val()
                const desc_en = $('#desc_en').val()
                const desc_th = $('#desc_th').val()
                const owner = $('#owner').val()
                //ส่งข้อมูลไป Store
                $.ajax({
                    type: "POST",
                    url: "{{ route('AnalysisGrowthChartSrc.store') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'modalType': modalType,
                        'desc_en': desc_en,
                        'desc_th': desc_th,
                        'owner': owner,
                    },
                    success: function(result) {

                        if (result == '200') {
                            dialogMessage('สำเร็จ', 'success', true)
                        } else {
                            dialogMessage('เกิดข้อผิดพลาด', 'warning')
                        }

                    },
                    error: function(xhr, status, error) {
                        dialogMessage('เกิดข้อผิดพลาด', 'warning')
                        console.log("getDataJSTree : xhr", xhr.responseText);
                        console.log(xhr.responseJSON.exception)
                        return;
                    }
                })
            })


            // ปุ่ม Preview ข้อมูล
            $('.tb_AnalysisGrowthChartSrc').on('click', '.previewData', function() {

                // Clear ค่า html
                $(".headerPreView").empty();
                $(".bodyPreview").empty();

                // ShowMoadl
                $('#modalPreView').modal('show');
                var id = $(this).attr("data-id");

                //เรียกข้อมูลของ id นั้นๆ
                $.ajax({
                    type: "POST",
                    url: "{{ route('AnalysisGrowthChartSrc.getDataEdit') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id,
                    },
                    success: function(result) {
                        // console.log(result)
                        //นำข้อมูลไปแสดง
                        $('.headerPreView').append(result.title);
                        var html = '';
                        html += '<p class="mr-3">desc en ' + result.desc_en + '</p>'
                        html += '<p class="mr-3">desc th ' + result.desc_th + '</p>'
                        html += '<p class="mr-3">owner ' + result.owner + '</p>'
                        $('.bodyPreview').append(html);

                    },
                    error: function(xhr, status, error) {
                        console.log("getDataJSTree : xhr", xhr.responseText);
                        console.log(xhr.responseJSON.exception)
                        return;
                    }
                })
            })

            //ปุ่มลบข้อมูลแบบ single
            $('.tb_AnalysisGrowthChartSrc').on('click', '.btnDel', function() {
                const id = $(this).attr("data-id");

                //แจ้งเตือนก่อนลบ
                Swal.fire({
                    text: "ต้องการลบข้อมูล ?",
                    icon: "warning",
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false,
                    confirmButtonText: 'ยืนยัน',
                }).then((result) => {
                    if (result.isConfirmed) {

                        //ส่งข้อมูลไปลบข้อมูล
                        $.ajax({
                            type: "POST",
                            url: "{{ route('AnalysisGrowthChartSrc.destroy') }}",
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id': id,
                            },
                            success: function(result) {

                                if (result == '200') {
                                    dialogMessage('ลบข้อมูลสำเร็จ', 'success', true)
                                } else {
                                    dialogMessage('เกิดข้อผิดพลาด', 'warning')
                                }

                            },
                            error: function(xhr, status, error) {
                                console.log("getDataJSTree : xhr", xhr.responseText);
                                console.log(xhr.responseJSON.exception)
                                return;
                            }
                        })
                    }
                })
            })

            //ปุ่มลบทั้งหมด
            $('#btnDeleteAll').click(function() {
                var idCheckBox = [];
                //loop ข้อมูลของ class Checkbox
                $('.dt-checkboxes').each(function(index, obj) {
                    if (this.checked === true) {
                        //นำข้อมูลใส่ใน Array
                        idCheckBox.push($(this).val());
                    }
                });
                if (idCheckBox.length > 0) {
                    //แจ้งเตือนก่อนลบ
                    Swal.fire({
                        text: "ต้องการลบข้อมูล ?",
                        icon: "warning",
                        showCancelButton: true,
                        customClass: {
                            confirmButton: 'btn btn-primary me-3',
                            cancelButton: 'btn btn-label-secondary'
                        },
                        buttonsStyling: false,
                        confirmButtonText: 'ยืนยัน',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            //ส่งข้อมูลไปลบข้อมูล
                            $.ajax({
                                type: "POST",
                                url: "{{ route('AnalysisGrowthChartSrc.destroy') }}",
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'arr_del': idCheckBox,
                                },
                                success: function(result) {

                                    if (result == '200') {
                                        dialogMessage('ลบข้อมูลสำเร็จ', 'success', true)
                                    } else {
                                        dialogMessage('เกิดข้อผิดพลาด', 'warning')
                                    }

                                },
                                error: function(xhr, status, error) {
                                    console.log("getDataJSTree : xhr", xhr
                                        .responseText);
                                    console.log(xhr.responseJSON.exception)
                                    return;
                                }
                            })
                        }
                    })
                } else {
                    dialogMessage('กรุณาเลือกข้อมูลก่อนลบ', 'warning')
                }


            })

            //ปุ่มแก้ไข
            $('.tb_AnalysisGrowthChartSrc').on('click', '.btnEdit', function() {
                var id = $(this).attr("data-id");
                var type = $('#modalType').val(id);
                // console.log(type)
                $('#modalStoreData').modal('show');
                $('#modalCenterTitle').text('แก้ไขข้อมูล');

                //เรียกข้อมูลของ id นั้นๆ
                $.ajax({
                    type: "POST",
                    url: "{{ route('AnalysisGrowthChartSrc.getDataEdit') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id,
                    },
                    success: function(result) {
                        //นำข้อมูลเข้า input
                        $('#desc_en').val(result.desc_en)
                        $('#desc_th').val(result.desc_th)
                        $('#owner').val(result.owner)
                    },
                    error: function(xhr, status, error) {
                        console.log("getDataJSTree : xhr", xhr.responseText);
                        console.log(xhr.responseJSON.exception)
                        return;
                    }
                })
            })

            // ข้อมูลของตาราง
            var table = $('.tb_AnalysisGrowthChartSrc').DataTable({
                ajax: {
                    "url": "{{ route('AnalysisGrowthChartSrc.getData') }}",
                    "type": "POST",
                    "data": {
                        '_token': _token
                    },
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'desc_en'
                    },
                    {
                        data: 'desc_en'
                    },
                    {
                        data: 'owner'
                    },
                    {
                        data: 'id'
                    },

                ],
                columnDefs: [
                    // Set ขนาดของลำดับ
                    {
                        width: 50,
                        targets: 1
                    },

                    // Set ขนาดของหัวข้อ
                    {
                        width: 100,
                        targets: 3
                    },
                    {
                        // For Checkboxes
                        targets: 0,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input" name="id[]" value="' +
                                data + '">';
                        },
                        checkboxes: {
                            selectAllRender: '<input type="checkbox" class="form-check-input">'
                        },
                        responsivePriority: 5
                    },

                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="d-inline-block">' +
                                '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>' +
                                '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                '<a href="javascript:;" class="dropdown-item previewData" data-id="' +
                                data + '">รายระเอียด</a>' +
                                '<div class="dropdown-divider"></div>' +
                                '<a href="javascript:;" class="dropdown-item text-danger delete-record btnDel" data-id="' +
                                data + '">ลบข้อมูล</a>' +
                                '</div>' +
                                '</div>' +
                                '<a href="javascript:;" class="btn btn-sm btn-icon item-edit btnEdit" data-id="' +
                                data +
                                '"data-type="edit"><i class="text-primary ti ti-pencil"></i></a>'
                            );
                        }
                    }
                ],

                //ตั้งค่าข้อมูลเรียงจากมากไปน้อย
                order: [
                    [1, 'desc']
                ],
                displayLength: 10,
                lengthMenu: [10, 15, 25, 50, 75, 100],
                responsive: {
                    details: {
                        type: 'column',

                    }
                }
            });

        })

        // Dialog
        function dialogMessage(message, icons, reload) {
            Swal.fire({
                text: message,
                icon: icons,
                showCancelButton: false,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'ยืนยัน',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (reload == true) {
                        window.location.reload()
                    }
                }
            })


        }
    </script>
@endsection
