@extends("_outLayout")
@section("body")
    <form action="" method="post" id="register_form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div id="tab1">
            @include("Users::register_tab1")
        </div>
        <div class="hidden" id="tab2">
            @include("Users::register_tab2")
        </div>
    </form>
    <script>
        $(function () {
            $("#next").click(function () {
                if ($("#register_form").valid()) {
                    $("#tab1").addClass("hidden");
                    $("#tab2").removeClass("hidden");
                }
            });
            $("#previous").click(function () {
                $("#tab1").removeClass("hidden");
                $("#tab2").addClass("hidden");
            });

            $('#register_form').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    email_confirm: {
                        equalTo: "#email"
                    },
                    password: {
                        required: true,
                    },
                    password_confirm: {
                        equalTo: "#password"
                    },
                    country_id: {
                        required: true,
                    },
                    city_id: {
                        required: true,
                    },
                    accept: {
                        required: true,
                    },
                }
                ,
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },
                messages: {
                    username: {
                        required: "حقل مطلوب",
                    },
                    email: {
                        required: "حقل مطلوب",
                        email: "يجب أن يكون إيميل صحيح",
                    },
                    email_confirm: {
                        equalTo: "الإيميلان غير متطابقان"
                    },
                    password: {
                        required: "حقل مطلوب",
                    },
                    password_confirm: {
                        equalTo: "كلمتا السر غير متطابقتان"
                    },
                    country_id: {
                        required: "حقل مطلوب",
                    },
                    city_id: {
                        required: "حقل مطلوب",
                    },
                    accept: {
                        required: "حقل مطلوب",
                    },
                }, submitHandler: function (form) {
                    form.submit();
                }
            });

            $("body").on('change', '#country_id', function () {
                var country_id = $('#country_id').val();
                $('#city_id').empty();
                $.ajax({
                    method: "POST",
                    url: '{{url("/")}}/getCitiesForCountry',
                    dataType: 'json',
                    data: {id: country_id, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        if (data.status) {
                            $('#city_id').append('<option disabled selected="">اختار المدينة من القائمة</option>');
                            for (var i = 0; i < data.cities.length; i++) {
                                $('#city_id').append('<option value="' + data.cities[i].pk_i_id + '">' + data.cities[i].s_name_ar + '</option>');
                            }

                        }//end if
                        else {
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            });
        });

    </script>
@endsection