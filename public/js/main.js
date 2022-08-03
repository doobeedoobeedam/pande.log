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

    const formDelete = document.querySelector('#formDelete');
    const btnDeleteLog = document.querySelectorAll('.deleteLog');
    btnDeleteLog.forEach(btn => btn.addEventListener('click', function() {
        var id = this.dataset.id;
        formDelete.setAttribute('action', "/logs/destroy/"+id);
    }));

    const btnDeleteUser = document.querySelectorAll('.deleteUser');
    btnDeleteUser.forEach(btn => btn.addEventListener('click', function() {
        var id = this.dataset.id;
        var warning = this.dataset.warning;
        formDelete.setAttribute('action', "/users/destroy/"+id);
        document.getElementById("delete-warning").innerHTML = warning;
    }));

    const formEditPassword = document.querySelector('#formEditPassword');
    const btnEditPassword = document.querySelector('.editPassword');
    btnEditPassword.addEventListener('click', function() {
        var id = btnEditPassword.dataset.id;
        formEditPassword.setAttribute('action', "/users/editPassword/"+id);
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