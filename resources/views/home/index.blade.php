@extends('layouts.app')

@section('content')

    <div style="height: 20px;"></div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-10 col-xl-9 mx-auto">
            <div class="row mt-3">
                <div class="col-3">
                    <button class="btn btn-primary" id="image_modal"> Add</button>
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
                                            <label for="religion">Image Title</label>
                                            <input name="title" type="text" class="form-control" id="title" placeholder="Image Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary btn-sm text-center margin_left_fifteen_px" id="image_upload_form_submit"></button>
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

        function getImages(url)
        {
            $('#image_no_record_section').addClass('sr-only');
            $('#image_show').empty();
            $.ajax({
                method: 'get',
                url: url,
                success: function (result) {
                    console.log(result);
                    if(result && result.length) {
                        console.log('record');
                        $.each(result, function (key, data) {
                            console.log(data.image_path);
                            $('#image_show').append($('<div class="col-2">')
                                .append("<img class='p-3' src='storage/"+ data.image_path +"' width='130' height='130' >")
                                .append("<h3> " + data.title + "</h3>")
                                .append('<button type="button" class="btn btn-primary remove_image" data-id="' + data.id + '">Remove</button>')
                                .append('</div>')
                            );
                        });
                    } else {
                        console.log(' no record');
                        $('#image_no_record_section').removeClass('sr-only');
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
            return true;
        }

        $(document).ready(function () {
            console.log('hello');
            currentPageUrl = '{{ url('get/image') }}/null';
            getImages(currentPageUrl);

        });

        function clearFileForm() {
            $('#image_form_message').empty();
            $('#image_upload_form').find('.text-danger').removeClass('text-danger');
            $('#image_upload_form').find('.is-invalid').removeClass('is-invalid');
            $('#image_upload_form').find('span').remove();
            return true;
        }

        $(document).on('keyup', '#search', function () {
            let searchKey = $('#search').val() === '' ? 'null' : $('#search').val();
            currentPageUrl = '{{ url('get/image') }}/' + searchKey;
            getImages(currentPageUrl);
            return false;
        });

        $('#modal').on('click', function () {
            $('#image_upload_form').trigger('reset');
            clearFileForm();
            $('#image_upload_form_submit').text('SAVE');
            $('#image_upload_modal').modal('show').on('shown.bs.modal', function () {
                $('#religion').focus();
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

        $(document).on('submit', '#image_upload_form' ,function () {
            clearFileForm();
            var bar = $('.image_bar');
            var percent = $('.image_percent');
            let fileData = new FormData(this);
            fileData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('image/upload') }}',
                data: fileData,
                processData: false,
                contentType: false,
                cache: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        //console.log(percentComplete);
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round( (evt.loaded * 100) / evt.total ) + '%';
                            //var barVal = Math.ceil(percentComplete);
                            bar.width(percentComplete);
                            percent.html(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function (result) {
                    console.log(result);
                    var percentVal = '100%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                    currentPageUrl = '{{ url('get/image') }}/null';
                    getImages(currentPageUrl);
                    $('.image_upload_modal_close').trigger('click');
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