<?php 
include_once __DIR__.'/common/session.php'; 
include_once __DIR__.'/../util/pathUtils.php';
include_once __DIR__.'/../util/userUtils.php';

goToLoginIfNotAdmin();

?>
<html lang="en">
<?php 
include_once __DIR__.'/common/header.php'; 
?>
<body>
<?php 
$currentActiveMenu = "loyaltyPrograms";
include_once __DIR__.'/common/menu.php' ;
?>
<div class="container mt-4">
<h2>Loyalty programs List :</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Program name</th>
      <th scope="col">Discount percentage</th>
      <th scope="col">Required trips number</th>
      <th scope="col">Colour code</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach (getLoyaltyPrograms() as $index => $loyaltyProgram) {
    echo "<tr>
      <th scope='row'>".($index+1)."</th>
      <td>".$loyaltyProgram["program_name"]."</td>
      <td>".$loyaltyProgram["discount_percentage"]."</td>
      <td>".$loyaltyProgram["required_trip_number"]."</td>
      <td ><div title='".$loyaltyProgram["color_code"]."' style='border:1px solid grey;width:20px;height:20px;background:".$loyaltyProgram["color_code"]."'></div>"."</td>
 <td>
  <a href='".getBaseUrl()."controller/loyaltyProgram/c_editLoyaltyProgram.php?id=".$loyaltyProgram["loyalty_program_id"]."'  style='cursor:pointer'>
  <i title='Edit' class='material-icons' style='color: green;'>edit</i></a>";
if ($loyaltyProgram["required_trip_number"] != 0) {
  echo "<a href='".getBaseUrl()."controller/loyaltyProgram/c_deleteLoyaltyProgram.php?id=".$loyaltyProgram["loyalty_program_id"]."' onclick='return confirmDelete();' style='cursor:pointer'><i title='Delete' class='material-icons' style='color: red;'>delete</i></a>";
}
echo "</td>
    </tr>";
  }
  ?>
   
  </tbody>
</table>

<script>
function confirmDelete() {
    return confirm("Do you confirm this action ?");
}

</script>


<div class="col-12">
    <form style="display: inline-block;" method="post" action="<?php echo getBaseUrl()?>controller/loyaltyProgram/c_newLoyaltyProgram.php">
        <button class="btn btn-primary" type="submit">Add New program</button>
    </form>
</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
