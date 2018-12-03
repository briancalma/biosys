<?= $this->Form->create() ?>

<form>
    <div class="login-form-head">
        <h4>Sign up</h4>
        <p>Hello there, Sign up and Join with Us</p>
    </div>
    <div class="login-form-body">
        <div class="form-gp">
            <label for="firstname">First Name</label>
            <?= $this->Form->action('firstname', ['id' => 'firstname']) ?>
            <i class="ti-user"></i>
        </div>

        <div class="form-gp">
            <label for="lastname">Last Name</label>
            <?= $this->Form->action('lastname', ['id' => 'lastname']) ?>
            <i class="ti-user"></i>
        </div>

        <div class="form-gp">
            <label for="username">UserName</label>
            <?= $this->Form->action('username', ['id' => 'username']) ?>
            <i class="ti-user"></i>
        </div>

        <div class="form-gp">
            <label for="email">Email Address</label>
            <?= $this->Form->action('email', ['id' => 'email','type' => 'email']) ?>
            <i class="ti-email"></i>
        </div>

        <div class="form-gp">
            <label for="password">Password</label>
            <?= $this->Form->action('password', ['id' => 'password','type' => 'password']) ?>
            <i class="ti-lock"></i>
        </div>
        <div class="submit-btn-area">
            <?= $this->Form->button('Submit <i class="ti-arrow-right"></i>',['id' => 'form_submit']) ?>
            <!-- 
                <div class="login-other row mt-4">
                    <div class="col-6">
                        <a class="fb-login" href="#">Sign up with <i class="fa fa-facebook"></i></a>
                    </div>
                    <div class="col-6">
                        <a class="google-login" href="#">Sign up with <i class="fa fa-google"></i></a>
                    </div>
                </div>
             -->
        </div>
        <div class="form-footer text-center mt-5">
            <p class="text-muted">Don't have an account? <a href="/login">Sign in</a></p>
        </div>
    </div>
</form>

<?= $this->Form->end() ?>