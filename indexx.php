<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="shopping-cart">

   <h1 class="heading"> عربة التسوق</h1>

   <table>
      <thead>
         <th>الصورة</th>
         <th>الاسم</th>
         <th>السعر</th>
         <th>العدد</th>
         <th>السعر الكلي</th>
         <th>العمل</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['price']; ?>ريال </td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="تعديل" class="option-btn">
               </form>
            </td>
            <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>ريال</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('إزالة العنصر من سلة التسوق؟');">حذف</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">العربة فارغة</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">المبلغ الإجمالي :</td>
         <td><?php echo $grand_total; ?>ريال</td>
         <td><a href="index.php?delete_all" onclick="return confirm('حذف كل المنتجات من العربة?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">حذف الكل</a></td>
      </tr>
   </tbody>
   </table>



</div>

</body>
</html>