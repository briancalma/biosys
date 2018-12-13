<?= $this->Form->create() ?>

    <div class="login-form-head">
        <h4>Sign In</h4>
        <p>Hello there, Sign in and start managing your PAYROLL SYSTEM</p>
    </div>
    <div class="login-form-body">
        <div class="form-gp"> 
            <label for="exampleInputEmail1">Email address</label>

            <?= $this->Form->action('email',['id' => 'exampleInputEmail1'])?>
            <!-- <input type="email" id="exampleInputEmail1"> -->
            <i class="ti-email"></i>
        </div>
        <div class="form-gp">
            <label for="exampleInputPassword1">Password</label>
            <?= $this->Form->action('password',['id' => 'exampleInputPassword1','type' => 'password'])?>
            <i class="ti-lock"></i>
        </div>
        <div class="row mb-4 rmber-area">
            <div class="col-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                </div>
            </div>
            <div class="col-6 text-right">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
        <div class="submit-btn-area">
            <?= $this->Form->button('Submit <i class="ti-arrow-right"></i>',['id' => 'form_submit']) ?>
            <!-- 
                <div class="login-other row mt-4">
                    <div class="col-6">
                        <a class="fb-login" href="#">Log in with <i class="fa fa-facebook"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="google-login" href="#">Log in with <i class="fa fa-google"></i></a>
                    </div>
                </div>
             -->
        </div>
        <div class="form-footer text-center mt-5">
            <p class="text-muted">Don't have an account? <a href="/register">Sign up</a></p>
        </div>
    </div>

<?= $this->Form->end() ?>