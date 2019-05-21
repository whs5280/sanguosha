@extends('common.home.auth')

@section('style')

@endsection

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">

                {{--@include('hint.status')--}}

                <section class="sign-area panel p-40">
                    <h3 class="sign-title">注册
                        <small>回到
                            <a href="/" class="color-green">首 页</a>
                        </small>
                        <span style="color: red; font-size: 12px;">
                        </span>
                    </h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">
                            <form class="p-40" id="register_form" method="post" action="/registerTo">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="sr-only">昵称</label>
                                    <input type="text" class="form-control input-lg" placeholder="昵称" name="nickname" value="{{ old('nickname') }}" required autofocus>
                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">邮箱</label>
                                    <input type="email" class="form-control input-lg" placeholder="邮箱" name="email" value="{{ old('emails') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">密码</label>
                                    <input type="password" class="form-control input-lg" placeholder="密码" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">手机号码</label>
                                    <input type="tel" class="form-control input-lg" placeholder="手机号码" name="phone" required>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only">验证码</label>

                                    <div style="position: relative;">
                                        <input width="50px" id="text" maxlength="6" type="text" class="form-control input-lg" name="code" placeholder="验证码" >
                                        {{--<img style="position: absolute;top: 0; right: 0; cursor: pointer;" src="/captcha" onclick="this.src='/captcha?'+Math.random()" alt="验证码" id="captcha">--}}
                                        <button style="position: absolute;top: 0; right: 0; cursor: pointer;" class="btn btn-danger btn_phone_send_code">获取验证码</button>
                                    </div>

                                    @if ($errors->has('code'))
                                        <div class="has-error">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- tooltips -->
                                <div class="bk_toptips" style="color: red;"><span></span></div>

                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="agree_terms">
                                    <label class="color-mid" for="agree_terms">
                                        我同意
                                        <a href="#" class="color-green" target="_blank">三国杀周边商城隐私声明</a>
                                    </label>
                                    <span class="has-error">
                                        <strong id="checkbox_text" class="help-block"></strong>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-block btn-lg">注  册</button>
                            </form>
                            <span class="or">Or</span>
                        </div>
                        <div class="col-sm-6 col-md-5 col-right">
                            <div class="social-login p-40">
                                @include('auth.oauth')
                                <div class="text-center color-mid">
                                    已经有账号 ? <a href="/login" class="color-green">登录</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
@endsection


@section('script')
    <script>
        $('#register_form').submit(function(){

            if(! $('#agree_terms').is(':checked')) {
                $('#checkbox_text').text('请同意三国杀周边商城协议');

                setTimeout(function(){
                    $('#checkbox_text').text('');
                }, 3000);

                return false;
            }

            return true;
        });
    </script>

    <script>
        var enable = true;
        $('.btn_phone_send_code').click(function(event) {
            if(enable == false) {
                return;
            }

            var phone = $('input[name=phone]').val();

            // 手机号不为空
            if(phone == '') {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('请输入手机号');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            // 手机号格式
            if(phone.length != 11 || phone[0] != '1') {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('手机格式不正确');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }

            $(this).removeClass('btn-info');
            //$(this).addClass('');
            enable = false;
            var num = 60;
            var interval = window.setInterval(function() {
                $('.btn_phone_send_code').html(--num + 's 重新发送');
                if(num == 0) {
                    $('.btn_phone_send_code').removeClass('');
                    //$('.btn_phone_send_code').removeAttribute('disabled');
                    enable = true;
                    window.clearInterval(interval);
                    $('.btn_phone_send_code').html('重新发送');
                }
            }, 1000);

            $.ajax({
                url: '/service/validate_phone/send',
                dataType: 'json',
                cache: false,
                data: {phone: phone},
                success: function(data) {

                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });

    </script>
@endsection
