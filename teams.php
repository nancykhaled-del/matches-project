<?php
include "includes/db.php";
include "includes/header.php";


 

?>
<form method="POST" action="addteam.php">
  <div class="d-flex m-2 p-2">
  <div class="col-5 ">

<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Add team"  name="addteam">
</div>

<button class="btn btn-success">Add Team</button>
  </div>
 

</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Class Name</th>
      <th scope="col">Point</th>
      <th scope="col">Goal Scored</th>
      <th scope="col">Goal Conceded</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>

        <?php
          $stmt = $conn->query("SELECT * FROM teams");
          $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
        
        foreach ($teams as $team): ?>
            <tr>
              <th scope="row"><?=$team['id'] ?></th>
              <td><?= $team['class_name'] ?></td>
              <td><?=$team['points'] ?></td>
              <td><?= $team['goalls_scored']?></td>
              <td><?=$team['goals_conceded']?></td>
              <td>
            <a href="edit.php?id=<?= $team['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= $team['id'] ?>" 
               class="btn btn-sm btn-danger"
               onclick="return confirm('Are you sure?')">Delete</a>
          </td>
            </tr>
        <?php endforeach; ?>
 
  </tbody>
</table>
<?php
include "includes/footer.php";
?>
