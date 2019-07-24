<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                style="background-image: url(&quot;<?= base_url() ?>assets/img/dogs/image3.jpeg&quot;);">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Welcome Back!</h4>
                                </div>
                                <form class="user" method="POST" action="<?= base_url() ?>account/login_auth">
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="text" name="username"
                                            placeholder="Email" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="password" name="password"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check"><input class="form-check-input custom-control-input"
                                                    type="checkbox" id="formCheck-1"><label
                                                    class="form-check-label custom-control-label"
                                                    for="formCheck-1">Remember Me</label></div>
                                        </div>
                                    </div><button class="btn btn-danger btn-block text-white btn-user"
                                        type="submit">Login</button>
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="forgot-password.html">Forgot
                                        Password?</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>