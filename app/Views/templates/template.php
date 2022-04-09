<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/datatables.min.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/boxicons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/auth.css">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/img/logop.png">
    <title><?= $title; ?></title>
</head>

<body oncontextmenu="return false;">
    <?= $this->include('templates/alerts'); ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
        <div class="container">
            <a class="navbar-brand me-5" href="<?= base_url('/home'); ?>" data-aos="fade-down">
                <img src="<?= base_url(); ?>/img/pande.log.svg" alt="" width="250" height="<?= $user_session['fullname']; ?>" class="img-fluid d-inline-block align-text-top">
            </a>
            <img data-aos="fade-down" src="<?= base_url(); ?>/img/<?= $user_session['photo']; ?>" width="60" alt="" class="rounded-circle navbar-toggler dropdown-toggle border-0" role="button" aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav menu">
                    <a class="nav-link <?= ($request->uri->getSegment(1) == 'home') ? 'active' : '' ?>" id="home-tab" href="<?= base_url('/home'); ?>">
                        <i class='bx bx-home me-1'></i> Home
                    </a>

                    <?php if($user_session['role'] == 'admin') : ?>

                        <a class="nav-link <?= ($request->uri->getSegment(1) == 'users' && $request->uri->getSegment(2) == '' || $request->uri->getSegment(1) == 'users' && $request->uri->getSegment(2) == 'edit') ? 'active' : '' ?>" id="user-tab" href="<?= base_url('users'); ?>">
                            <i class='bx bxs-user me-1'></i> Users
                        </a>

                        <a class="nav-link <?= ($request->uri->getSegment(1) == 'users' && $request->uri->getSegment(2) == 'create') ? 'active' : '' ?>" id="add-tab" href="<?= base_url('users/create'); ?>">
                            <i class='bx bx-plus-circle me-1'></i> New User
                        </a>

                        <a class="nav-link <?= ($request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == '' || $request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == 'create' || $request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == 'edit') ? 'active' : '' ?>" id="log-tab" href="<?= base_url('logs'); ?>">
                            <i class='bx bx-note me-1'></i> My Logs
                        </a>

                    <?php else : ?>

                        <a class="nav-link <?= ($request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == '' || $request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == 'edit') ? 'active' : '' ?>" id="log-tab" href="<?= base_url('logs'); ?>">
                            <i class='bx bx-note me-1'></i> Logs
                        </a>

                        <a class="nav-link <?= ($request->uri->getSegment(1) == 'logs' && $request->uri->getSegment(2) == 'create') ? 'active' : '' ?>" id="add-tab" href="<?= base_url('logs/create'); ?>"><i class='bx bx-plus-circle me-1'></i> New Log</a>

                    <?php endif; ?>
                    
                    <a class="nav-link md <?= ($request->uri->getSegment(1) == 'users' && $request->uri->getSegment(2) == 'detail') ? 'active' : '' ?>" href="<?= base_url('users/detail/' . $user_session['id']); ?>"><i class='bx bxs-user-detail me-1'></i> Profile</a>
                    <a class="nav-link md" href="#" data-bs-toggle="modal" data-bs-target="#signout"><i class='bx bx-log-out me-1'></i> Sign out</a>

                </div>
                <li class="nav-item dropdown navbar-nav ms-auto" data-aos="fade-left">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-1 mt-1"><?= $user_session['fullname']; ?></span> <img src="<?= base_url(); ?>/img/<?= $user_session['photo']; ?>" width="40" alt="" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu border-0 rounded-0 shadow-sm" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?= base_url('users/detail/' . $user_session['id']); ?>">Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signout">Sign out</a></li>
                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <!-- SIGNOUT MODAL -->
    <div class="modal fade" id="signout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-body border-0">
                    <h5 class="modal-title text-red fs-3" id="exampleModalLabel">#Sign Out</h5>
                    Are you sure wanna sign out?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn bg-warning border-0 shadow-sm text-white" data-bs-dismiss="modal">Close</button>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn bg-primary text-white border-0 shadow-sm">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="tab-content py-5">

            <?= $this->renderSection('content'); ?>

        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-body border-0">
                    <h5 class="modal-title text-red fs-3" id="exampleModalLabel">#Delete</h5>
                    <span id="delete-warning" class="text-danger"></span> Are you sure wanna delete this data?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn bg-warning border-0 shadow-sm text-white" data-bs-dismiss="modal">Close</button>
                    <form action="" method="POST" id="formDelete">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn bg-primary border-0 shadow-sm text-white">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.11.5/rr-1.2.8/datatables.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
            
            $('#data-log').DataTable({
                serverSide: false,
                order: [],
                columnDefs: [ 
                    { 'targets': [3], 'orderable': false, },
                    { 'targets': [5], 'orderable': false, },
                ],
            });

            $('.deleteLog').click(function() {
                var id = $(this).data('id');
                $('#formDelete').attr('action', "<?= base_url('logs/destroy'); ?>/" + id);
            });

            $('.deleteUser').click(function() {
                var id = $(this).data('id');
                var warning = 'When a user account is deleted, all personal logs to that user is removed too.'
                $('#formDelete').attr('action', "<?= base_url('users/destroy'); ?>/" + id);
                document.getElementById("delete-warning").innerHTML = warning;
            });

            $('.detailLog').click(function() {
                var date = $(this).data('date');
                var time = $(this).data('time');
                var location = $(this).data('location');
                var temperature = $(this).data('temperature');
                document.getElementById("detail-date").innerHTML = date;
                document.getElementById("detail-time").innerHTML = time;
                document.getElementById("detail-location").innerHTML = location;
                document.getElementById("detail-temperature").innerHTML = temperature + '&deg';
            });

            $('.editPassword').click(function() {
                var id = $(this).data('id');
                $('#formEditPassword').attr('action', "<?= base_url('users/editPassword'); ?>/" + id);
            });
        });

        function imgPreview() {
            const imgPreview = document.querySelector('.img-preview');
            const photo = document.querySelector('#photo');

            const filePhoto = new FileReader();
            filePhoto.readAsDataURL(photo.files[0]);

            filePhoto.onload = function(e){
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>
</html>