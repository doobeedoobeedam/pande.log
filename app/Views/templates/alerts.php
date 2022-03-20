<?php if(session()->getFlashdata('success')) : ?>
    <div class="alert bg-success text-white position-absolute top-0 end-0 mt-3 me-2 alert-dismissible fade show" role="alert" data-aos="fade-left">
        <strong>Success!</strong> <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif(session()->getFlashdata('error')) : ?>
    <div class="alert bg-danger text-white position-absolute top-0 end-0 mt-3 me-2 alert-dismissible fade show" role="alert" data-aos="fade-left">
        <strong>Error!</strong> <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>