<?php

session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $cate_query = "INSERT INTO categories 
    (name, slug, description, status, popular, image)
    VALUES ('$name','$slug','$description','$status','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename); 

        redirect("category.php","เพิ่มสำเร็จ");
    }
    else
    {
        redirect("add-category.php","มีบางอย่างผิดพลาด");
    }
}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1':'0';
    $popular = isset($_POST['popular']) ? '1':'0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description',
    status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "อัปเดตสำเร็จ");
    }
    else
    {
        redirect("edit-category.php?id=$category_id", "มีบางอย่างผิดพลาด");
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = $_POST['delete_category_btn'];
    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run)
    {

        redirect("category.php", "ลบสำเร็จ");
       
    }
    else
    {
        redirect("category.php", "มีบางอย่างผิดพลาด");
        
    }
}
else if(isset($_POST['add_product_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    if($name != "" && $slug != "" && $description != "")
    {
  
        $product_query = "INSERT INTO products (category_id,name,slug,description,original_price,selling_price,
        qty,status,trending,image) VALUES
        ('$category_id','$name','$slug','$description','$original_price','$selling_price','$qty','$status','$trending','$filename') ";

        $product_query_run = mysqli_query($con, $product_query);

        if($product_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            
            redirect("products.php","เพิ่มสำเร็จ");
        }
        else
        {
            redirect("add-product.php","มีบางอย่างผิดพลาด");
        }
          
    }
    else
    {
        redirect("add-product.php","All fields are mandatory");
    }
}
else if(isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1':'0';
    $trending = isset($_POST['trending']) ? '1':'0';

    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', description='$description',
        original_price='$original_price', selling_price='$selling_price', qty='$qty', status='$status', trending='$trending', image='$update_filename' WHERE id='$product_id' ";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if($update_product_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "อัปเดตสำเร็จ");
    }
    else
    {
        redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
    }
} 
else if(isset($_POST['delete_product_btn']))
{
    $product_id = $_POST['delete_product_btn'];
    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run)
    {
        redirect("products.php", "ลบสำเร็จ");
       
    }
    else
    {
        redirect("products.php", "มีบางอย่างผิดพลาด");
        
    }
}
else if(isset($_POST['update_order_btn']))
{
    $table_no = $_POST['table_number'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE table_number='$table_no' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    redirect("vieworder.php?t=$table_no", "อัปเดตออเดอร์เสร็จสิ้น");
}
else
{
    header('Location: ../categories.php');
}


if(isset($_POST['delete_user_btn']))
{
    $user_id = $_POST['delete_user_btn'];
    $delete_query = "DELETE FROM users WHERE id='$user_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);
    
    if($delete_query_run)
    {
        redirect("userM.php", "ลบสำเร็จ");
       
    }
    else
    {
        redirect("userM.php", "มีบางอย่างผิดพลาด");
        
    }
}

if(isset($_POST['update_user_btn']))
{
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role_as = $_POST['table_number'];

    $updateOrder_query = "UPDATE users SET name = '$name', email = '$email', phone ='$phone', role_as ='$role_as' WHERE id = '$user_id' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    if($updateOrder_query_run){
    $_SESSION['message'] = "สำเร็จ";
    header('Location: userM.php');
    }
}
else
{
    $_SESSION['message'] = "ไม่สำเร็จ";
    header('Location: userM.php');   
}

if(isset($_POST['add_user_btn']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $check_email_query = "SELECT email FROM users WHERE email = '$email'"; 
    $check_email_query_run = mysqli_query($con, $check_email_query);

    $passwordmd5 = md5($password);
    $insert_query = "INSERT INTO users (name, email, phone,password) VALUES ('$name','$email','$phone','$passwordmd5')";
    $insert_query_run = mysqli_query($con, $insert_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['message'] = "อีเมล์ซ้ำ";
        header('Location: userM.php');
    }
    else if($insert_query_run)
    {
        $_SESSION['message'] = "ลงทะเบียนสำเร็จ";
        header('Location: adduser.php');
    }
    else
    {
        $_SESSION['message'] = "ลงทะเบียนสำเร็จ";
        header('Location: userM.php');
    }

}


?>
