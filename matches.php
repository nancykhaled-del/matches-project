<?php
include "includes/db.php";
include "includes/header.php";

/* Add Match */
if($_SERVER['REQUEST_METHOD']=="POST"){

    $stmt=$conn->prepare("INSERT INTO matches (team1_id,team2_id,team1_goals,team2_goals,match_date) VALUES (?,?,?,?,?)");
    $stmt->execute([
        $_POST['team1'],
        $_POST['team2'],
        $_POST['team1_goals'],
        $_POST['team2_goals'],
        $_POST['match_date']
    ]);

    updateTeamStats($conn,$_POST['team1'],$_POST['team1_goals'],$_POST['team2_goals']);
    updateTeamStats($conn,$_POST['team2'],$_POST['team2_goals'],$_POST['team1_goals']);

    echo '<div class="alert text-center" style="background:#ff1493;color:#000;">Match added successfully ⚽</div>';
}

/* Update Points */
function updateTeamStats($conn,$teamId,$goalsFor,$goalsAgainst){
    $points=0;
    if($goalsFor>$goalsAgainst){
        $points=3;
    } elseif($goalsFor==$goalsAgainst){
        $points=1;
    }

    $stmt=$conn->prepare("UPDATE teams 
        SET points=points+?,
            goalls_scored=goalls_scored+?,
            goals_conceded=goals_conceded+?
        WHERE id=?");

    $stmt->execute([$points,$goalsFor,$goalsAgainst,$teamId]);
}

/* Get Teams */
$teams=$conn->query("SELECT * FROM teams")->fetchAll();

/* Get Matches */
$matches=$conn->query("
SELECT m.*,
       t1.class_name as team1_name,
       t2.class_name as team2_name
FROM matches m
JOIN teams t1 ON m.team1_id=t1.id
JOIN teams t2 ON m.team2_id=t2.id
ORDER BY match_date DESC
")->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
<title>Matches</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
body {
    background-color: #0f172a;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border-radius: 12px;
    /* background-color: #111; */
    border: 1px solid #0b0b0b;
}

.card-header {
    background-color: #0b0b0b !important;
    color: #000 !important;
}

.form-select, .form-control {
    background-color: #111;
    color: #fff;
    border: 1px solid #070707;
}

.form-select option {
    color: #000;
}

.btn-success {
    background-color: #e996be;
    border-color: #e996be;
    color: #000;
}

.btn-success:hover {
    background-color: #e996be;
    border-color: #e996be;
}

.table {
    color: #fff;
    border-color: #090909;
}

.table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #111;
}

.table-dark {
    background-color: #181818 !important;
    color: #fbf5f5;
}

.table td, .table th {
    vertical-align: middle;
    border-color: #0b0a0b;
}
</style>
</head>
<body>

<div class="container mt-5">

<div class="card shadow mb-4">
<div class="card-header">
<h4 class="text-white">⚽ Add Match Result</h4>
</div>
<div class="card-body">
<form method="POST" class="row g-3">

<div class="col-md-3">
<select class="form-select" name="team1" required>
<option value="">Team 1</option>
<?php foreach($teams as $team){ ?>
<option value="<?= $team['id'] ?>"><?= htmlspecialchars($team['class_name']) ?></option>
<?php } ?>
</select>
</div>

<div class="col-md-1">
<input type="number" name="team1_goals" class="form-control" min="0" required>
</div>

<div class="col-md-1">
<input type="number" name="team2_goals" class="form-control" min="0" required>
</div>

<div class="col-md-3">
<select class="form-select" name="team2" required>
<option value="">Team 2</option>
<?php foreach($teams as $team){ ?>
<option value="<?= $team['id'] ?>"><?= htmlspecialchars($team['class_name']) ?></option>
<?php } ?>
</select>
</div>

<div class="col-md-3">
<input type="datetime-local" name="match_date" class="form-control" required>
</div>

<div class="col-md-1 d-grid">
<button class="btn btn-success">Save</button>
</div>

</form>
</div>
</div>

<div class="card shadow">
<div class="card-header">
<h5 class="text-white">📅 Match History</h5>
</div>

<table class="table table-striped text-center mb-0">
<thead class="table-dark">
<tr>
<th>Date</th>
<th>Match</th>
<th>Result</th>
</tr>
</thead>
<tbody>
<?php foreach($matches as $match){ ?>
<tr>
<td><?= date('d/m/Y H:i',strtotime($match['match_date'])) ?></td>
<td><?= htmlspecialchars($match['team1_name']) ?> vs <?= htmlspecialchars($match['team2_name']) ?></td>
<td><b><?= $match['team1_goals'] ?> - <?= $match['team2_goals'] ?></b></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

</div>
</body>
</html>
<?php
include "includes/footer.php";
?>