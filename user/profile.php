<?php
include '../navbar.php';

if (!isset($_SESSION['id'])) {
    redirect('/');
}
$id = $_SESSION['id'];
$result = $db->query("SELECT * FROM users WHERE id_user='$id'");
$user = $result->fetch_assoc();
?>

<main>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar text-center">
                    <div class="profile-userpic">
                        <img src="<?= $user['foto_user'] === '' ? $blank : $avatar ?>"
                             class="img-fluid" alt="">
                    </div>
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?= $user['nama_user'] ?>
                        </div>
                        <div class="profile-usertitle-job">
                            User
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button"
                                class="btn btn-outline-secondary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#imgModal">Ubah Foto
                        </button>
                        <button type="button"
                                class="btn btn-outline-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#passwordModal">Ubah Password
                        </button>
                    </div>
                </div>

                <!-- Modal Change Password-->
                <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog small">
                        <div class="modal-content rounded-5 shadow">
                            <div class="modal-header p-5 pb-4 border-bottom-0">
                                <!-- <h5 class="modal-title">Modal title</h5> -->
                                <h2 class="mx-1 mb-0">Change password</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <div class="modal-body p-5 pt-0">
                                <form method="post" action="<?php action('user/edit');?>" class="">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="old_password" class="form-control rounded-4"
                                               placeholder="old password">
                                        <label for="">Old Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_password" class="form-control rounded-4"
                                               placeholder="new password">
                                        <label for="">New Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="confirm_password"
                                               class="form-control rounded-4" placeholder="confirm new password">
                                        <label for="">Confirm New Password</label>
                                    </div>
                                    <div class="form-floating mx-6">
                                        <button class="w-100 mb-2 btn btn-lg rounded-4 btn-dark" name="ubah_pass"
                                                type="submit">Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Photo Profile -->
                <div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imgModalLabel">pilih foto kamu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data" action="<?php action('user/edit');?>">
                                    <div class="form-group mb-4">

                                        <input type="file" name="foto_user">
                                    </div>
                                    <button class="btn btn-info" name="update_foto">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <form class="small" method="post" action="<?php action('user/edit');?>">
                        <p class="text-center h1 mb-4 mx-1 mx-md-4 mt-4">Edit Profile</p>

                        <div class="row my-1">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="mx-1 mx-md-4">
                                    <label for="username"><b>Username</b></label>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <input type="text"
                                           id="username"
                                           name="username"
                                           class="form-control"
                                           value="<?= $user['username'] ?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="mx-1 mx-md-4">
                                    <label for="username"><b>Name</b></label>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control"
                                           value="<?= $user['nama_user'] ?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="mx-1 mx-md-4">
                                    <label for="email"><b>Email</b></label>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-control"
                                           value="<?= $user['email'] ?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="mx-1 mx-md-4">
                                    <label for="phone_number"><b>No. Tlp</b></label>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <input type="number"
                                           id="no_tlp"
                                           name="phone_number"
                                           class="form-control"
                                           value="<?= $user['no_tlp'] ?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="mx-1 mx-md-4">
                                    <label for="address"><b>Address</b></label>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <input type="text"
                                           id="address"
                                           name="address"
                                           class="form-control"
                                           value="<?= $user['alamat_user'] ?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mb-3 mb-lg-4">
                            <button type="submit"
                                    name="update_profile"
                                    class="btn btn-primary btn-lg">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<script>
    document.title = "Edit Profile";
</script>

<?php
// include '../footer.php';
if (isset($_SESSION['swal'])){
    echo "<script>swal({title: '".$_SESSION['swal']['title']."', icon: '".$_SESSION['swal']['icon']."'})</script>";
    unset($_SESSION['swal']);
}
?>
