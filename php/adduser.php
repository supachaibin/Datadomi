<?php 

include('includes/header.php'); 


?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Users</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0">ชื่อ</label>
                                <input type="text" required name="name" placeholder="ใส่ชื่อ" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">อีเมล์</label>
                                <input type="text" required name="email" placeholder="ใส่อีเมล์" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">เบอร์</label>
                                <input type="number" required name="phone" placeholder="ใส่เบอร์" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">รหัสผ่าน</label>
                                <input type="password" required name="password" placeholder="ใส่รหัสผ่าน" class="form-control">
                            </div>
                            <div class="col-md-6 mt-4">
                                <button type="submit" class="btn btn-warning" name="add_user_btn">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>