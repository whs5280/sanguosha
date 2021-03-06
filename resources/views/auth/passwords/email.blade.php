@extends('common.home.auth')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-60">
            <div class="container">


                <section class="sign-area panel p-40">
                    <h3 class="sign-title">找回密码</h3>
                    <div class="row row-rl-0">
                        <div class="col-sm-6 col-md-7 col-left">
                            <form class="p-40 form-horizontal" method="POST" action="/password/email">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="sr-only">邮箱</label>
                                    <input type="text" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="邮箱" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-block btn-lg">找回密码</button>
                            </form>
                            <span class="or">Or</span>
                        </div>

                        <div class="col-sm-6 col-md-5 col-right">
                            <div class="social-login p-40">
                                @include('auth.oauth')

                                <div class="text-center color-mid">
                                    重置密码成功？ <a href="/login" class="color-green">去登录</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
