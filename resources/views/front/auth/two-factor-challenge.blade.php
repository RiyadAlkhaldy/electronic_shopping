<x-front-layout title="2FA Challenge">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>You must enter 2FA.</p>
                            </div>
                             
                            @if($errors->has('code'))
                            <div class="alert alert-danger">
                                {{ $errors->first('code') }}
                            </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA Code</label>
                                <input class="form-control" type="text" name="code" id="reg-fn"  >
                            </div>
                            @if($errors->has('recovery_code'))
                            <div class="alert alert-danger">
                                {{ $errors->first('recovery_code') }}
                            </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-recovery_code">Recovery Code</label>
                                <input class="form-control" type="text" name="recovery_code" id="reg-recovery_code"  >
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">sibmit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>
