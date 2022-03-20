<?= $this->extend('templates/auth'); ?>
<?= $this->section('main'); ?>
    <main class="form signup">
        <form class="card border-0 shadow-sm py-4 px-5" action="<?= base_url('Auth/registration'); ?>" method="POST">
            <h1 class="mb-3 fw-bold display-2 logo">
                <span class="red">s</span><span class="green">i</span><span class="purple">g</span><span class="blue">n</span><span class="orange">u</span><span class="info">p</span>
            </h1>
            <div class="form-floating mb-3">
                <input type="text" id="nik" placeholder="NIK" name="number" class="form-control <?= ($validation->hasError('number')) ? 'is-invalid' : '' ?>" value="<?= old('number'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('number'); ?>
                </div>
                <label for="nik">NIK</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="fullname" placeholder="Full Name" name="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" value="<?= old('fullname'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
                <label for="fullname">Full Name</label>
            </div>            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" id="password1" placeholder="Password" name="password1" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : '' ?>" value="<?= old('password1'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password1'); ?>
                        </div>
                        <label for="nik">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="password" id="password2" placeholder="re-Password" name="password2" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?>" value="<?= old('password2'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password2'); ?>
                        </div>
                        <label for="nik">re-Password</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-100 btn btn-lg bg-primary text-white border-0 mb-3">Sign up</button>
            <small>Already have a account? <a href="<?= base_url('auth/signin'); ?>">Sign in!</a></small>
        </form>
    </main>
<?= $this->endSection(); ?>
