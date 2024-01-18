<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>超值季度购</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ URL::asset('h5/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <link rel="stylesheet" href="{{ URL::asset('h5/css/style.default.css').'?'.microtime() }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('h5/css/bootstrap.min.detail.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('h5/css/app.min.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('h5/css/icons.min.css') }}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('h5/css/lyy.css').'?'.microtime() }}">
</head>
<script src="{{ URL::asset('h5/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('h5/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('h5/js/message.js') }}"></script>
<style>
    body {
        background-image: url("{{ URL::asset('pageImg/78.png') }}");
        background-repeat: round;
        background-size: cover;
    }

    .bannar_div {
        padding-right: 0;
        padding-left: 0;
    }

    .page-content {
        padding: 10px 0 !important;
    }

    .regbtn {
        width: 100%;
        border-radius: 3.25rem;
        background: linear-gradient(90deg, #352820 0%, #A88A80 100%);
        font-size: 17px;
        font-family: Source Han Sans CN-Regular, Source Han Sans CN;
        font-weight: 400;
        color: #FFF0D2;
    }

    .regbtn:hover {
        text-decoration: none;
        background-color: #352820;
        border-color: #352820;
        color: #FFF0D2;
    }

    .getcode{
        display: inline-block;
        float:right;
        font-size: 10px;
        border-radius: 3.25rem;
        background:#ffffff;
        color:#E2452A;
        font-weight: 700;
        line-height: 1.5;
        padding: 0.375rem 0.75rem;
    }

    .h5-text{
        font-size: 25px;
        font-family: Source Han Sans CN-Bold, Source Han Sans CN;
        font-weight: 700;
        color: #1A1A1A;
    }

</style>
<body>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 bannar_div">
                <img class="bannar" src="{{ URL::asset('pageImg/79.png') }}" alt="">
            </div>
        </div>

        <div class="row" style="margin-top: -200px;">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <h5 class="font-size-18 mb-4" style="text-align: center;"><i class="text-primary h5-text" ></i>
                                        立即登录</h5>
                                    <div class="mb-3">
                                        <input id="cell" class="input-material" type="text" maxlength="11" name="cell"
                                               placeholder="请输入手机号">
                                        <div class="invalid-feedback">
                                            请确定手机号是否正确
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <input id="code" class="input-material" maxlength="8" type="text"
                                                       name="code" placeholder="验证码"
                                                       style="width:50%;display: inline-block;">
                                                <span id="getcode" name="getcode" class="getcode">发送验证码
                                </span>
                                                <div class="invalid-feedback">
                                                    验证码不能为空
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button id="login" type="button"
                                                name="login_submit" class="btn btn-primary-1 regbtn">
                                            立即登录
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" class="jumptypestr" value="{{ $type }}">
</div>

</body>
<script>
    var time = 60;
    var clickBtn = false;
    //等待时间
    function waitTime(option) {
        if (time == 0) {
            clickBtn = false;
            $('#getcode').attr("disabled", false);
            $('#getcode').text('获取验证码');
            time = 60;
        } else {
            clickBtn = true;
            $('#getcode').attr("disabled", true);
            $('#getcode').text("重新发送(" + time + ")");
            time--;
            setTimeout(function () {
                waitTime(option)
            }, 1000)
        }
    }


    $(function () {
        var flagCell = false;
        var flagCode = false;

        $("#cell").change(function () {
            var cell = $("#cell").val();
            if (cell.length < 11 || cell.length > 11) {
                $("#cell").removeClass("form-control is-valid")
                $("#cell").addClass("form-control is-invalid");
                flagCell = false;
            } else {
                $("#cell").removeClass("form-control is-invalid")
                $("#cell").addClass("form-control is-valid");
                flagCell = true;
            }
        });

        $("#code").change(function () {
            var code = $("#code").val();
            if (code.length < 1 || code.length > 8) {
                $("#code").removeClass("form-control is-valid")
                $("#code").addClass("form-control is-invalid");
                flagCode = false;
            } else {
                $("#code").removeClass("form-control is-invalid")
                $("#code").addClass("form-control is-valid");
                flagCode = true;
            }
        })


        //获取验证码
        $('#getcode').click(function () {
            if(clickBtn){
                return false;
            }
            clickBtn = true;
            $("#code").attr("required", true);
            $('#getcode').attr("disabled", true);
            var cell = $("#cell").val();
            var reg = /^1[3456789]\d{9}$/;
            if (!reg.test(cell)) {
                clickBtn = false;
                alert('请确认手机号是否填写正确');
                this.removeAttribute("disabled");
                $("input[name='cell']").focus();
            } else {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });

                $.ajax({
                    url: "{{url('auth/login/code')}}",
                    type: "POST",
                    data: {cell: cell},
                    success: function (result) {
                        console.log(result);
                        if (result.code != 0) {
                            clickBtn = false;
                            alert(result.msg);
                            $('#getcode').attr("disabled", false);
                        }else{
                            //开始倒计时
                            waitTime(this);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("网络错误，请重新提交");
                        window.location.reload();
                    }
                });
            }
        });

        $("#login").click(function () {
            $('#login').attr("disabled", true);
            if (!flagCell) {
                $("#cell").addClass("form-control is-invalid");
            }
            if (!flagCode) {
                $("#code").addClass("form-control is-invalid");
            }

            if (flagCell && flagCode) {
                var cell = $("#cell").val();
                var code = $('#code').val();
                var jump = $('.jumptypestr').val();
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });

                $.ajax({
                    url: "{{url('auth/login')}}",
                    type: "POST",
                    data: {cell: cell, code: code},
                    success: function (result) {
                        console.log(result);
                        if (result.code != 200) {
                            alert(result.msg);
                            $('#login').attr("disabled", false);
                        } else {
                            if(jump == 'vip'){
                                window.location.href="{{ url('/act/detail/2') }}";
                            }else{
                                window.location.href="{{ url('/act/detail') }}";
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        alert("网络错误，请重新提交");
                        window.location.reload();
                    }
                });
            }
        })
    })
</script>
</html>
