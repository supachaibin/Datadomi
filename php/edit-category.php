<?php 

include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    <h4>แก้ไขหมวดหมู่
                                        <a href="category.php" class="btn btn-warning float-end">< กลับ</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>" >
                                                <label for="">ชื่อ</label>
                                                <input type="text" required name="name" value="<?= $data['name'] ?>" placeholder="ใส่ชื่อ" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">สลัก</label>
                                                <input type="text" required name="slug" value="<?= $data['slug'] ?>" placeholder="ใส่สลัก" class="form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">คำอธิบาย</label>
                                                <textarea rows="3" required required name="description" placeholder="ใส่คำอธิบาย" class="form-control"><?= $data['description'] ?></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">เพิ่มรูป</label>
                                                <input type="file" name="image" class="form-control mb-2">
                                                <label for="">รูป</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                                                <img src="../uploads/<?= $data['image']; ?>" alt=""height="50px" width="50px" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">แนะนำ</label>
                                                <input type="checkbox" <?= $data['popular'] ? "checked":"" ?> name="popular" >
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning" name="update_category_btn">อัปเดต</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>