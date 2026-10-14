<?php
include "includes/db.php";
include "includes/header.php";

$upcomingMatches = $conn->query("
SELECT m.*, t1.class_name as team1_name, t2.class_name as team2_name
FROM matches m
JOIN teams t1 ON m.team1_id = t1.id
JOIN teams t2 ON m.team2_id = t2.id
WHERE m.match_date > NOW()
ORDER BY m.match_date ASC
")->fetchAll();

$pastMatches = $conn->query("
SELECT m.*, t1.class_name as team1_name, t2.class_name as team2_name
FROM matches m
JOIN teams t1 ON m.team1_id = t1.id
JOIN teams t2 ON m.team2_id = t2.id
WHERE m.match_date <= NOW()
ORDER BY m.match_date DESC
LIMIT 5
")->fetchAll();
?>

<style>

body{
background:#0f0f0f;
font-family:'Segoe UI',sans-serif;
color:white;
}

.card{
background:#1a1a1a;
border:none;
border-radius:15px;
box-shadow:0 0 25px rgba(249,168,212,0.25);
}

.card-header{
background:black;
color:white;
border-radius:15px 15px 0 0 !important;
}

.nav-tabs{
border-bottom:1px solid #333;
}

.nav-tabs .nav-link{
color:#ccc;
border:none;
}

.nav-tabs .nav-link.active{
background:#f9a8d4;
color:black;
border-radius:8px;
}

.nav-tabs .nav-link:hover{
color:#f9a8d4;
}

.list-group-item{
background:#222;
border:none;
border-radius:10px;
margin-bottom:10px;
color:white;
transition:0.3s;
}

.list-group-item:hover{
transform:scale(1.02);
background:#2c2c2c;
}

.badge{
font-size:13px;
padding:6px 10px;
}

.bg-primary{
background:#f9a8d4 !important;
color:black !important;
}

.bg-success{
background:#22c55e !important;
}

.bg-warning{
background:#facc15 !important;
color:black !important;
}

.bg-info{
background:#38bdf8 !important;
color:black !important;
}

.bg-secondary{
background:#6b7280 !important;
}

h2{
font-weight:bold;
letter-spacing:1px;
}

</style>

<div class="container mt-4">

<div class="card mb-4">

<div class="card-header">
<h2>Match Schedule</h2>
</div>

<div class="card-body">

<ul class="nav nav-tabs">

<li class="nav-item">
<button class="nav-link active"
data-bs-toggle="tab"
data-bs-target="#upcoming">
Upcoming Matches
</button>
</li>

<li class="nav-item">
<button class="nav-link"
data-bs-toggle="tab"
data-bs-target="#past">
Recent Results
</button>
</li>

</ul>

<div class="tab-content p-3">

<!-- Upcoming Matches -->

<div class="tab-pane fade show active" id="upcoming">

<?php if (count($upcomingMatches) > 0): ?>

<div class="list-group">

<?php foreach ($upcomingMatches as $match): ?>

<div class="list-group-item">

<div class="d-flex justify-content-between">

<h5>
<?= htmlspecialchars($match['team1_name']) ?>
vs
<?= htmlspecialchars($match['team2_name']) ?>
</h5>

<small>
<?= date('D, M j', strtotime($match['match_date'])) ?>
</small>

</div>

<p>

<span class="badge bg-info">
<?= date('g:i A', strtotime($match['match_date'])) ?>
</span>

<span class="badge bg-secondary">
Field #1
</span>

</p>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<div class="alert alert-info">
No upcoming matches scheduled yet.
</div>

<?php endif; ?>

</div>


<!-- Past Matches -->

<div class="tab-pane fade" id="past">

<?php if (count($pastMatches) > 0): ?>

<div class="list-group">

<?php foreach ($pastMatches as $match): ?>

<div class="list-group-item">

<div class="d-flex justify-content-between">

<h5>

<?= htmlspecialchars($match['team1_name']) ?>

<span class="badge bg-primary">
<?= $match['team1_goals'] ?>
</span>

-

<span class="badge bg-primary">
<?= $match['team2_goals'] ?>
</span>

<?= htmlspecialchars($match['team2_name']) ?>

</h5>

<small>
<?= date('M j', strtotime($match['match_date'])) ?>
</small>

</div>

<p>

<?php
$winner = ($match['team1_goals'] > $match['team2_goals'])
? $match['team1_name']
: (($match['team2_goals'] > $match['team1_goals'])
? $match['team2_name']
: null);
?>

<?php if ($winner): ?>

<span class="badge bg-success">
<?= htmlspecialchars($winner) ?> won
</span>

<?php else: ?>

<span class="badge bg-warning">
Draw
</span>

<?php endif; ?>

</p>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<div class="alert alert-info">
No match results available yet.
</div>

<?php endif; ?>

</div>

</div>

</div>

</div>

</div>
<?php
include "includes/footer.php";
?>