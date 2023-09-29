<?php 

include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
                            <div class="card">
                                <div class="card-header">
                                    <h4>Change Password
                                        <a href="userM.php" class="btn btn-warning float-end">< Back</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name ="id" value="<?= $user['id'];?>"> 
                                            <div class="col-md-6">
                                                <label for="">รหัสผ่าน</label>
                                                <input type="text" required name="password" placeholder="ใส่รหัสผ่าน" class="form-control">
                                            </div>
                                             <div class="col-md-12 mt-3">
                                                <button type="submit" class="btn btn-warning" value="<?= $user['id']; ?>" name="changepassword">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>