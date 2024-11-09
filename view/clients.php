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
$currentActiveMenu = "clients";
include_once __DIR__.'/common/menu.php' ;
?>
<div class="container mt-4">
<h2>Client List :</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Programme de fidélité</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach (getClients() as $index => $client) {
    echo "<tr>
      <th scope='row'>".($index+1)."</th>
      <td>".$client["first_name"]."</td>
      <td>".$client["last_name"]."</td>
      <td>".$client["email"]."</td>
      <td>".$client["program_name"]."</td>
 <td>
            <a href='".getBaseUrl()."controller/client/c_deleteClient.php?email=".$client["email"]."' onclick='return confirmDelete();' style='cursor:pointer'>
            <i class='material-icons' style='color: red;'>delete</i></a>
           <button  type='button' onclick='addFakeReservation(\"".$client["email"]."\")' class='btn btn-primary btn-sm' >Add fake reservations</button>
            
        </td>
    </tr>";
  }
  ?>
   
  </tbody>
</table>

<script>
function confirmDelete() {
    return confirm("Do you confirm this action ?");
}

function addFakeReservation(email) {
  window.location.href = "<?php echo getBaseUrl()?>controller/fake/c_fakeReservations.php?email="+email;

}

</script>

<form method="post" action="<?php echo getBaseUrl()?>controller/fake/c_fakeClients.php">
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Add Fake Clients</button>
    </div>
</form>


</div>
<?php 
include_once __DIR__.'/common/footer.php' 
?>
</body>
</html>
