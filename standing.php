<?php
include "includes/db.php";
include "includes/header.php";

$teams = $conn->query(" 
SELECT  
t.*, 
(t.goalls_scored - t.goals_conceded) AS goal_difference, 

(SELECT COUNT(*) FROM matches m  
WHERE (m.team1_id = t.id OR m.team2_id = t.id)) AS matches_played, 

(SELECT COUNT(*) FROM matches m  
WHERE ((m.team1_id = t.id AND m.team1_goals > m.team2_goals) OR  
       (m.team2_id = t.id AND m.team2_goals > m.team1_goals))) AS wins, 

(SELECT COUNT(*) FROM matches m  
WHERE ((m.team1_id = t.id OR m.team2_id = t.id) AND  
       m.team1_goals = m.team2_goals)) AS draws 

FROM teams t 
ORDER BY t.points DESC, goal_difference DESC, t.goalls_scored DESC
")->fetchAll();
?>

<style>

body{
background:#0f172a;
color:white;
font-family:Arial;
}

.standings-card{
background:#1a1a1a;
border-radius:12px;
box-shadow:0 0 20px rgba(255,105,180,0.2);
padding:20px;
}

.standings-title{
color:#f9a8d4;
font-weight:bold;
margin-bottom:20px;
}

.table{
color:white;
}

.table thead{
background:#ff4da6;
color:white;
}

.table tbody tr{
transition:0.3s;
}

.table tbody tr:hover{
background:#262626;
}

.rank{
font-weight:bold;
color:#ff4da6;
}

.points{
font-weight:bold;
color:#ff4da6;
}

</style>

<div class="container mt-4">

<div class="standings-card">

<h2 class="standings-title">Tournament Standings</h2>

<div class="table-responsive">

<table class="table">

<thead>
<tr>
<th>#</th>
<th>Team</th>
<th>P</th>
<th>W</th>
<th>D</th>
<th>L</th>
<th>GF</th>
<th>GA</th>
<th>GD</th>
<th>Pts</th>
</tr>
</thead>

<tbody>

<?php foreach ($teams as $index => $team): ?>

<tr>

<td class="rank"><?= $index+1 ?></td>

<td><?= htmlspecialchars($team['class_name']) ?></td>

<td><?= $team['matches_played'] ?></td>

<td><?= $team['wins'] ?></td>

<td><?= $team['draws'] ?></td>

<td><?= $team['matches_played'] - $team['wins'] - $team['draws'] ?></td>

<td><?= $team['goalls_scored'] ?></td>

<td><?= $team['goals_conceded'] ?></td>

<td><?= $team['goal_difference'] ?></td>

<td class="points"><?= $team['points'] ?></td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

</div>
</div>
</div>
<?php
include "includes/footer.php";
?>