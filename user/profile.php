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
        <div class="profile-sidebar text-center">
          <div class="profile-userpic">
            <img src="../assets/img/user/<?php echo $user['foto_user'] ?>"
            class="img-fluid" alt="">
          </div>
          <!-- SIDEBAR USER TITLE -->
          <div class="profile-usertitle">
            <div class="profile-usertitle-name">
              <?php echo $user['nama_user'] ?>
            </div>
            <div class="profile-usertitle-job">
              User
            </div>
          </div>
          <!-- END SIDEBAR USER TITLE -->
          <!-- SIDEBAR BUTTONS -->
          <div class="profile-userbuttons">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#imgModal">Ubah Foto</button>
            <button type="button" class="btn btn-outline-danger btn-sm">Ubah Password</button>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="imgModalLabel">pilih foto kamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="../actions/user/edit.php">
                <div class="form-group mb-4">
                  
                  <input type="file" name="foto_user">
                </div>
                  <button class="btn btn-info" name="update_foto">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
              </div>
            </div>
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
              value="update_profile"
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
// include '../footer.php';
?>
