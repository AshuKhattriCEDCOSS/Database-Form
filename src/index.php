<?php
include("classes/DB.php");         //Including Classes
include("config.php");
if(isset($_POST['addproduct']))
{
    $pid=$_POST['pid'];
    $pname=$_POST['pname'];
    $pcategory=$_POST['pcategory'];
    $price=$_POST['price'];
    $stmt = "INSERT INTO Product(P_ID,P_Name,P_Category,P_Price) Values($pid,'$pname','$pcategory',$price)";
    try {
        DB::getInstance()->exec($stmt);
        header('Location:index.php');
    } catch (Exception $e) {

        return "<h5>Email is Already Registered<br> Please Sign In!!<h5>";
    }
}
    $stmt = DB::getInstance()->prepare("SELECT P_ID, P_Name, P_Category,P_Price FROM Product");   //Fetching Records From DataBase
    $stmt->execute();
    $ss = array();
    foreach ($stmt->fetchAll() as $user) {
      array_push($ss, "<tr><td>" . $user['P_ID'] . "</td><td>" . $user['P_Name'] . "</td><td>" . $user['P_Category'] . "</td><td>" . $user['P_Price'] . "</td><td><form method='POST'><input type='hidden' name='id' value=". $user['P_ID']."><input type='submit' name='editbutton' value='Edit'></form></td><td><form method='POST'><input type='hidden' name='id' value=". $user['P_ID']."><input type='submit' name='deletebutton' value='Delete'></form></td></tr>");
}
if (isset($_POST['deletebutton'])) {
    $id = $_POST['id'];
    $stmt = DB::getInstance()->prepare("DELETE FROM Product WHERE P_ID='$id'");   //Fetching Records From DataBase
    $stmt->execute();
    header('Location:index.php');
  }
  if (isset($_POST['editbutton'])) {
   
    $id = $_POST['id'];
    $stmt = DB::getInstance()->prepare("SELECT P_ID, P_Name, P_Category,P_Price FROM Product WHERE P_ID='$id'");   //Fetching Records From DataBase
    $stmt->execute();
    foreach ($stmt->fetchAll() as $user) {
        $pid=$user['P_ID'];
        $pname=$user['P_Name'];
        $pcategory=$user['P_Category'];
        $price=$user['P_Price'];   

    }
    
} 
if(isset($_POST['updateproduct']))
{
  $pid=$_POST['pid'];  
  $pname=$_POST['pname'];
  $pcategory=$_POST['pcategory'];
  $price=$_POST['price'];
 
$stmt=DB::getInstance()->prepare("UPDATE Product SET P_Name='$pname', P_Category='$pcategory', P_Price='$price' WHERE P_ID='$pid' ");
$stmt->execute();
header('Location:index.php');
}
  
  
?>
<html>
    <head>
    
        <title>
           Database Test
</title>
    </head>
    <style>
        #add{
            display: block;
        }
        #update{
            display:none;
        }
    </style>
    <body>
        <?php
        if (isset($_POST['editbutton'])) {
            echo "<style>#add{display:none}#update{display:block}#ID{pointer-events: none}</style>";
        }
        ?>
        <form method="POST">
            <label>Product ID</label>
            <input  type="text" id="ID" name="pid" value=<?php echo $pid ?> >
            <br><br>
            <label>Product Name</label>
            <input  type="text" name="pname"  value=<?php echo $pname ?> >
            <br><br>
            <label>Product Category</label>
            <input  type="text" name="pcategory"  value=<?php echo $pcategory ?> >
            <br><br>
            <label>Product Price</label>
            <input  type="text" name="price"  value=<?php echo $price ?> >
            <br><br>
            <input class="btn btn-primary" id="add" type="submit" name="addproduct" value="Add">
            <input class="btn btn-primary"  id="update" type="submit" name="updateproduct" value="Update">
</form>
<div>
            <table>
              <thead>
                <tr>
                  <th scope="col">Product ID</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Product Category</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>


                </tr>
              </thead>
              <tbody>
                <?php 
                foreach($ss as $s) {
                  echo $s;
                } ?>
              </tbody>
            </table>
          </div>
    </body>
</html>