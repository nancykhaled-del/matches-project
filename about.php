<?php
include "includes/header.php";
?>

<style>

body{
background:#0f0f0f;
font-family:'Segoe UI',sans-serif;
color:white;
}

.about-container{
max-width:1000px;
margin:auto;
padding:40px;
}

.about-card{
background:#1a1a1a;
border-radius:15px;
padding:40px;
box-shadow:0 0 25px rgba(249,168,212,0.25);
}

.about-title{
color:#f9a8d4;
font-weight:bold;
margin-bottom:20px;
}

.about-section{
margin-top:30px;
}

.about-box{
background:#222;
padding:20px;
border-radius:10px;
margin-bottom:15px;
transition:0.3s;
}

.about-box:hover{
background:#2c2c2c;
transform:translateY(-3px);
}

.highlight{
color:#f9a8d4;
font-weight:bold;
}

</style>

<div class="about-container">

<div class="about-card">

<h1 class="about-title">About The Tournament</h1>

<p>
This website is designed to manage and display information about a football tournament.  
It allows users to view <span class="highlight">match schedules</span>, 
<span class="highlight">results</span>, and <span class="highlight">team standings</span>.
</p>

<div class="about-section">

<h3 class="about-title">Features</h3>

<div class="about-box">
⚽ View upcoming matches and match schedules
</div>

<div class="about-box">
🏆 See the latest match results
</div>

<div class="about-box">
📊 Check the tournament standings and team rankings
</div>

<div class="about-box">
👥 Manage teams and matches easily
</div>

</div>

<div class="about-section">

<h3 class="about-title">About This Project</h3>

<p>
This tournament management system was developed using 
<span class="highlight">PHP</span>, 
<span class="highlight">MySQL</span>, and 
<span class="highlight">Bootstrap</span> to provide a simple and clean interface
for organizing sports competitions.
</p>

</div>

</div>

</div>

<?php
include "includes/footer.php";
?>