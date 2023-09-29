<?php 

include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>แก้ไขผู้ใช้
                                        <a href="userM.php" class="btn btn-warning float-end">< กลับ</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" name ="id" value="<?= $user['id'];?>"> 
                                            <div class="col-md-6">
                                                <label for="">ชื่อ</label>
                                                <input type="text" required name="name" value="<?= $user['name']; ?>" placeholder="ใส่ชื่อ" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0">อีเมล์</label> 
                                                <input type="text" required name="email" value="<?= $user['email']; ?>" placeholder="ใส่อีเมล์" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0">เบอร์</label> 
                                                <input type="text" required name="phone" value="<?= $user['phone']; ?>" placeholder="ใส่เบอร์" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-bold">บทบาท</label>
                                                <select name="table_number" required class="form-select mb-2" >
                                                    <option selected>บทบาท</option>
                                                    <option value="0"<?=$user['role_as'] == '0' ? 'selected':''?>>ลูกค้า</option>
                                                    <option value="1"<?=$user['role_as'] == '1' ? 'selected':''?>>พนักงาน</option>
                                                </select>
                                             </div>
                                             <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning" value="<?= $user['id']; ?>" name="update_user_btn">อัปเดต</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>