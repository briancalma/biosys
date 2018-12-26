<div class="row">
    <div class="col-12 mt-5">

        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <?= $this->Form->create() ?>
                    <h3 style="margin:50px 0">Personal Information</h3>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">First name</label>
                            <input name="firstname" type="text" class="form-control" id="validationCustom01" placeholder="First name" value="<?= $account->firstname?>" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input name="lastname" type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="<?= $account->lastname?>" required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input name="email" type="email" class="form-control" id="validationCustomUsername" placeholder="Email" aria-describedby="inputGroupPrepend" required="" value="<?= $account->email ?>">
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Birthdate</label>
                            <input name="birthdate" type="date" class="form-control" id="validationCustom01" placeholder="Birth Date" required="" value="<?= $account->birthdate ?>">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Age</label>
                            <input name="age" type="number" class="form-control" id="validationCustom02" placeholder="Age" min="18" max="70" required="" value="<?= $account->age ?>">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Gender</label> <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" checked="" id="customRadio4" name="gender" class="custom-control-input" value="male">
                                <label class="custom-control-label" for="customRadio4">Male</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" checked="" id="customRadio5" name="gender" class="custom-control-input" value="female">
                                <label class="custom-control-label" for="customRadio5">Female</label>
                            </div>
                        </div>
                    </div>

                    <label for="validationCustom01">Address</label>
                    <input name="address" type="text" class="form-control" id="validationCustom01" placeholder="Address" required="" value="<?= $account->address?>">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                    <h3 style="margin:50px 0">Employement Information</h3>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="col-form-label">Department</label>
                                <select class="form-control" name="department">
                                    <option value="office_1">Office 1</option>
                                    <option value="office_2">Office 2</option>
                                    <option value="facility">Facility</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="col-form-label">Position</label>
                                <select class="form-control" name="position">
                                    <option value="position_1">Position 1</option>
                                    <option value="position_2">Position 2</option>
                                    <option value="janitor">Janitor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="example-number-input" class="col-form-label">Rate Per Hour</label>
                                <input class="form-control" type="number" value="<?= $account->rate_per_hour?>" id="example-number-input" name="rate">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">BENEFITS</label>
                            <div class="custom-control custom-checkbox">
                                <?php if($account->philhealth == true) { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="philhealth" checked>
                                <?php } else { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="philhealth">
                                <?php } ?>
                                <label class="custom-control-label" for="customCheck1">PHILHEALTH</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <?php if($account->sss == true) { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="sss" checked>
                                <?php } else { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="sss">
                                <?php } ?>    
                                
                                <label class="custom-control-label" for="customCheck2">SSS</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <?php if($account->pagibig == true) { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="pagibig" checked>
                                <?php } else { ?>
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="benefits[]" value="pagibig">
                                <?php } ?>
                                <label class="custom-control-label" for="customCheck3">PAGIBIG</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-6">
                            <?= $this->Form->submit('SAVE', ['class' => 'btn btn-md btn-primary btn-block']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

