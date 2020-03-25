@extends('layouts.app', [
    'title' => 'Login'
])

@section('content')

    <div class="row">
        <div class="col text-center" style="margin-top: 0px; font-size: 200%;">
            User Log In
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col" style="margin-top: 20px; padding: 50px 100px; border: 1px solid #f8d7da;">
            <div id="form_message" class="text-danger text-center"></div>
            <form id="login_form">
                <div class="form-group">
                    <label for="email">Log in ID</label>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Mobile Number or Email Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">Log in</button>
                    <button type="button" class="btn btn-primary btn-sm" id="import_user">Import User</button>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>

    <script language="JavaScript">
        $('#login_form').submit(function(){
            $('#form_message').empty();
            let formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                method: 'post',
                url: '{{ url('login') }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result === 'Authorized User') {
                        location = '{{ url('/user') }}';
                    } else {
                        $('#form_message').text(result);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    if (xhr.responseJSON.hasOwnProperty('message')) {
                        $('#form_message').text('Too Many Attempts Plz Try Again After 30mints');
                    }
                }
            });
            return false;
        });

        $(document).on('click', '#import_user', function () {
            let data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
           $.ajax({
               method: 'post',
               url: '{{ url('import/user/faker') }}',
               data: data,
               contentType: false,
               processData: false,
               cache: false,
               success: function (result) {
                   console.log(result);
                   $.toaster({ title: 'Success', priority : 'success', message : result });
               },
               error: function (xhr) {
                   console.log(xhr);
               }
           });
           return false;
        });
    </script>
@endsection
