<?php 

include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
                            <div class="card">
                                <div class="card-header">
                                    <h4>แก้ไขสินค้า
                                        <a href="products.php" class="btn btn-warning float-end">< กลับ</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class ="mb-0">เลือกหมวดหมู่</label>
                                                <select name="category_id" class="form-select mb-2" >
                                                    <option selected>เลือกหมวดหมู่</option>
                                                    
                                                </select>
                                            </div>
                                            <input type="hidden" name="product_id" value="<?= $data['id']; ?>" >
                                            <div class="col-md-6">
                                                <label class ="mb-0">ชื่อ</label>
                                                <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="ใส่ชื่อ" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0">สลัก</label> 
                                                <input type="text" required name="slug" value="<?= $data['slug']; ?>" placeholder="ใส่สลัก" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class ="mb-0">คำอธิบาย</label>
                                                <textarea rows="3" required name="description" placeholder="ใส่คำอธิบาย" class="form-control mb-2"><?= $data['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0">ราคาเดิม</label>
                                                <input type="text" required name="original_price" value="<?= $data['original_price']; ?>" placeholder="ใส่ราคาเดิม" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class ="mb-0">ราคาลด</label>
                                                <input type="text" required name="selling_price" value="<?= $data['selling_price']; ?>" placeholder="ใส่ราคาลด" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">ใส่รูป</label>
                                                <input type="file" name="image" class="form-control mb-2">
                                                <label for="">รูป</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                                                <img src="../uploads/<?= $data['image']; ?>" alt=""height="50px" width="50px" >
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class ="mb-0">จำนวน</label>
                                                    <input type="number" required name="qty" value="<?= $data['qty']; ?>" placeholder="ใส่จำนวน" class="form-control mb-2">
                                                </div>
                        
                                                <div class="col-md-3">
                                                    <label class ="mb-0">แนะนำ</label> <br>
                                                    <input type="checkbox" name="trending" <?= $data['trending'] == '0'?'':'checked' ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning" name="update_product_btn">อัปเดต</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>