<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    </title>
    <link rel="icon" type="image/png" href="site_img/icon.png">
    <link rel="stylesheet" href="css/Product_list.css">
    <?php include 'connect.php'; ?>
    <?php include 'connect.php';
      $url='site_img/background img.jpg'; 
      if(isset ($_REQUEST['id'])){
        $item_id=$_REQUEST['id'];
        $query2="DELETE FROM item WHERE item_id=$item_id ";
        $result2=mysqli_query($connect,$query2);
        if ($result2) {
            $url = $_SERVER['PHP_SELF'];
            header("Location: Product_list.php");
            exit;
        }
       } ?>

    <script>
   
    function checkdelete(){
        return confirm('Are you sure to delete this record?');
    }

    </script> 
   
</head>
<body>

   <style type="text/css">
        body
        {
        background-image:url('<?php echo $url ?>');
        }
    </style>

<div class="head"> <button type="button" class="btn1" onclick="location.href='logout.php'">Log Out</button> </div>

   <div class="first">
          <a  href="add_item.php"><h2>Add product</h2></a>
          <a  href="Product_list.php" class="now"><h2>Product list</h2></a>
          <a  href="Sales_list.php"><h2>Sales list</h2></a>
          <a  href="Users_list.php"><h2>Users list</h2></a>
   </div>

  
   <h1>Product List</h1>
   <table >
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Details</th>
      <th>Unsold</th>
      <th>Sold</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
   

   <?php 
   $query="SELECT item_id,name,description,qty FROM item ";
   $result= mysqli_query($connect,$query);
   

   if($result){
   while ($r=mysqli_fetch_assoc($result)){

    $id=$r['item_id'];
    $name=$r['name'];
    $description=$r['description'];
    $qty=$r['qty'];
    

    $query1="SELECT SUM(qty) FROM order_details WHERE item_id=$id";
    $result1= mysqli_query($connect,$query1);
    if($result1){
    $a=mysqli_fetch_assoc($result1);
    $total=$a['SUM(qty)'];} else{ $total= 0 ;}
    $difference=$qty-$total;



    //echo "<table>";
      echo "<tr>";
      echo "<td> $id </td>";
      echo "<td> <a href='item_details.php?item_id=".$id."'style='

        background-color: #white;
        padding: 0;
        margin: 0;
        border: 0;
        text-align: center;
        text-decoration: none;
        color: black;'> $name </a></td>";
      echo "<td> $description </td>";
      echo "<td> $difference</td>"; 
      echo "<td> $total</td>";
      echo "<td> <a href='edit_product.php?id=".$r['item_id']."' class='btn'>Edit</a></td>";
      echo "<td> <a href='Product_list.php?id=".$r['item_id']."' class='btn' onclick='return checkdelete()'>Delete</a></td>";
      echo "</tr>";
    //echo "</table>";       

      }

      echo "</table>";
    
    }else{
        echo"Query is wrong";
    }

    

   ?>

    
    
</body>
</html>