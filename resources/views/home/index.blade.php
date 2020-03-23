@extends('layouts.app')

@section('content')

    <div style="height: 20px;"></div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
            <div class="row mt-3">
                <div class="col-3">
                    <button class="btn btn-primary" id="add"> Add</button>
                </div>
                <div class="col-9">
                    <form id="search_form">
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search....">
                    </form>
                </div>
            </div>
            <hr>

            <div class="row sr-only" style="margin-top: 15px;" id="record_section">
                <div class="col">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-2" style="padding-top: 10px;">
                            <input type="checkbox" id="bulk_records"> All Check
                        </div>
                        <div class="col-sm-2">
                            <select name="bulk_status" id="bulk_status" class="form-control">
                                <option value="">Bulk Action</option>
                                <option value="Active">Make Active</option>
                                <option value="Inactive">Make Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" id="bulk_apply" class="btn btn-sm btn_orange">APPLY</button>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Narrative</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="records"></tbody>
                    </table>
                </div>
            </div>

            <div class="row sr-only" id="no_record_section">
                <div class="col text-center">
                    No Record Found
                </div>
            </div>

            <div class="row sr-only">
                <div class="col" id="pagination">

                </div>
            </div>


            <div class="modal fade" id="modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add User</h5>
                            <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="padding-left: 80px; padding-right: 80px; padding-bottom: 50px;">
                            <div id="form_message" class="text-center text-danger">

                            </div>
                            <form id="form" enctype="multipart/form-data">
                                <input name="id" type="hidden" id="id">

                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input name="email" type="text" class="form-control" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input name="mobile_number" type="text" class="form-control" id="mobile_number" placeholder="Mobile Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary btn-sm text-center margin_left_fifteen_px" id="form_submit"></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div style="height: 100px;"></div>

    <script language="JavaScript">

        let currentPageUrl = '';
        function setPageDefaults() {
            $('#record_section').addClass('sr-only');
            $('#bulk_records').prop('checked', false);
            $('#bulk_status').val('');
            $('#records').empty();
            $('#no_record_section').addClass('sr-only');
            $('#record_count_section').removeClass('col-sm-12 col-sm-2');
            $('#record_count_section').empty();
            $('#pagination').empty();
            return true;
        }

        function showRecord(result) {
            if(result.data.total > 0) {
                $('#record_count_section').append('Record: ' + result.data.from + ' ~ ' + result.data.to + ' of ' + result.data.total);
                $.each(result.data.data, function (key, record) {
                    $('#records').append($('<tr></tr>')
                        .append('<td><input type="checkbox" class="bulk_record" value="' + record.id + '"> ' + ++key + '</td>')
                        .append('<td>' + record.name + '</td>')
                        .append('<td>' + record.email + '</td>')
                        .append('<td>' + record.mobile_number + '</td>')
                        .append('<td>' + record.status + '</td>')
                        .append('<td>' + record.narrative + '</td>')
                        .append('<td><i class="far fa-edit edit text_orange" data-id="' + record.id + '" style="cursor: pointer; font-size: 1rem;" data-toggle="tooltip" title="Edit"></i></td>')
                    );
                });
                $('#record_section').removeClass('sr-only');
                $('#pagination').append(result.pagination);
                $('#pagination').parent().removeClass('sr-only');
            } else {
                $('#no_record_section').removeClass('sr-only');
            }
        }

        function getRecords(url)
        {
            setPageDefaults();
            $.ajax({
                method: 'get',
                url: url,
                success: function (result) {
                    console.log(result);
                    showRecord(result);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return true;
        }

        $(document).on('click', '.page-link', function () {
            let pageLink = $(this).attr('href');
            let value = pageLink.split('=');
            console.log(value[1]);
            setPageDefaults();
            $.ajax({
               method: 'get',
               url: '{{ url('get/user/record/null?page=') }}' + value[1],
               cache: false,
               success: function (result) {
                   console.log(result);
                   showRecord(result);
               },
               error: function (xhr) {
                   console.log(xhr);
               }
            });
            return false;
        });

        $(document).ready(function () {
            console.log('hello');
            currentPageUrl = '{{ url('get/user/record') }}/null';
            getRecords(currentPageUrl);

        });

        function clearForm() {
            $('#form_message').empty();
            $('#form').find('.text-danger').removeClass('text-danger');
            $('#form').find('.is-invalid').removeClass('is-invalid');
            $('#form').find('span').remove();
            return true;
        }

        $(document).on('keyup', '#search', function () {
            let searchKey = $('#search').val() === '' ? 'null' : $('#search').val();
            currentPageUrl = '{{ url('get/image') }}/' + searchKey;
            getImages(currentPageUrl);
            return false;
        });

        $(document).on('click', '#add' ,function () {
            $('#form').trigger('reset');
            clearForm();
            $('#form_submit').text('SAVE');
            $('#modal').modal('show').on('shown.bs.modal', function () {
                $('#name').focus();
            });
            return false;
        });

        function readPhotoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('submit', '#form' ,function () {
            clearForm();
            let data = new FormData(this);
            data.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('save/user/record') }}',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (result) {
                    console.log(result);
                    $('.modal_close').trigger('click');
                    currentPageUrl = '{{ url('get/user/record') }}/null';
                    getRecords(currentPageUrl);
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.hasOwnProperty('responseJSON')) {
                        if (xhr.responseJSON.hasOwnProperty('errors')) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                if (key !== 'id') {
                                    $('#' + key).after('<span></span>');
                                    $('#' + key).parent().find('label').addClass('text-danger');
                                    $('#' + key).addClass('is-invalid');
                                    $.each(value, function (k, v) {
                                        $('#' + key).parent().find('span').addClass('text-danger').append('<p>' + v + '</p>');
                                    });
                                } else {
                                    $.each(value, function (k, v) {
                                        $('#image_form_message').append('<p>' + v + '</p>');
                                    });
                                }
                            });
                        }
                    }
                }

            });
            return false;
        });

        $(document).on('click', '.remove_image', function () {
            let id = $(this).data('id');
            console.log(id);
            $.ajax({
                method: 'get',
                url: '{{ url('image/file/remove') }}/' + id,
                cache: false,
                success: function (result) {
                    console.log(result);
                    currentPageUrl = '{{ url('get/image') }}/null';
                    getImages(currentPageUrl);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return false;
        });

    </script>

@endsection