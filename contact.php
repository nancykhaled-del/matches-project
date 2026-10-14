<?php
include "includes/header.php";
?>

<style>
body{
background:#0f0f0f;
font-family:'Segoe UI',sans-serif;
color:white;
}

.contact-container{
max-width:800px;
margin:auto;
padding:40px;
}

.contact-card{
background:#1a1a1a;
border-radius:15px;
padding:40px;
box-shadow:0 0 25px rgba(249,168,212,0.25);
}

.contact-title{
color:#f9a8d4;
font-weight:bold;
margin-bottom:20px;
text-align:center;
}

.contact-box{
margin-bottom:30px;
}

.contact-box label{
display:block;
margin-bottom:5px;
color:#f9a8d4;
font-weight:bold;
}

.contact-box input,
.contact-box textarea{
width:100%;
padding:12px;
border-radius:8px;
border:none;
background:#222;
color:white;
transition:0.3s;
}

.contact-box input:focus,
.contact-box textarea:focus{
outline:none;
background:#2c2c2c;
}

.contact-box button{
background:#f9a8d4;
color:black;
padding:12px 25px;
border:none;
border-radius:8px;
cursor:pointer;
font-weight:bold;
transition:0.3s;
}

.contact-box button:hover{
background:#ff6ec7;
color:white;
}

.contact-info{
background:#222;
padding:20px;
border-radius:10px;
margin-top:20px;
}

.contact-info h4{
color:#f9a8d4;
margin-bottom:10px;
}

.contact-info p{
margin:0;
color:#ccc;
}

</style>

<div class="contact-container">

<div class="contact-card">

<h1 class="contact-title">Contact Us</h1>

<!-- Form -->
<div class="contact-box">
<form action="send_message.php" method="POST">
<label for="name">Name</label>
<input type="text" id="name" name="name" placeholder="Your name" required>

<label for="email">Email</label>
<input type="email" id="email" name="email" placeholder="Your email" required>

<label for="message">Message</label>
<textarea id="message" name="message" rows="5" placeholder="Your message..." required></textarea>

<button type="submit">Send Message</button>
</form>
</div>

<!-- Contact Info -->
<div class="contact-info">
<h4>Our Info</h4>
<p>Email: info@tournament.com</p>
<p>Phone: +20 123 456 789</p>
<p>Address: Al Mahallah al Kubra, Egypt</p>
</div>

</div>
</div>

<?php
include "includes/footer.php";
?>