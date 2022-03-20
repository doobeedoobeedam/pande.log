<?= $this->extend('templates/auth'); ?>
<?= $this->section('main'); ?>
    <main class="form">
        <form class="card border-0 shadow-sm p-5" action="<?= base_url('auth/login'); ?>" method="POST">
            <h1 class="mb-3 fw-bold display-2 logo">
                <span class="red">s</span><span class="green">i</span><span class="purple">g</span><span class="blue">n</span><span class="orange">i</span><span class="info">n</span>
            </h1>

            <div class="form-floating mb-3">
                <input type="text" id="number" name="number" placeholder="NIK" class="form-control <?= ($validation->hasError('number')) ? 'is-invalid' : '' ?>" value="<?= old('number'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('number'); ?>
                </div>
                <label for="number">NIK</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : '' ?>" 
                value="<?= old('fullname'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('fullname'); ?>
                </div>
                <label for="fullname">Full Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="w-100 btn btn-lg bg-primary border-0 mb-3 text-white">Sign in</button>
            <small>Not have an account? <a href="<?= base_url('auth/signup'); ?>">Let's Sign Up!</a></small>
        </form>
    </main>
<?= $this->endSection(); ?>
