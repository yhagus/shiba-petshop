<?php
include '../navbar.php';

if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
$id = $_SESSION['id'];
$result = $db->query("SELECT * FROM users WHERE id_user='$id'");
$user = $result->fetch_assoc();
?>


<main>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg"
                             class="img-responsive" alt="">
                    </div>
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Marcus Doe
                        </div>
                        <div class="profile-usertitle-job">
                            User
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-outline-secondary btn-sm">Ubah Foto</button>
                        <button type="button" class="btn btn-outline-danger btn-sm">Ubah Password</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <form class="small" method="post" action="../actions/user/edit.php">
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
                                           value="<?= $user['username']?>"
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
                                           value="<?= $user['nama_user']?>"
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
                                           value="<?= $user['email']?>"
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
                                           value="<?= $user['no_tlp']?>"
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
                                           value="<?= $user['alamat_user']?>"
                                           autocomplete="nope"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mb-3 mb-lg-4">
                            <input type="submit"
                                   name="submit"
                                   value="Save Changes"
                                   class="btn btn-primary btn-lg">
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
include '../footer.php';
?>
