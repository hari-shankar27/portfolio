<?php
session_start();
require "db.php"; // PDO connection file

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

// PDO secure query
$stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$data){
    echo "Message not found!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
    font-family: 'Poppins', sans-serif;
    background: #0f172a;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* container effect */
h2{
    position: absolute;
    top: 30px;
    font-size: 28px;
    color: #38bdf8;
}

/* form box */
form{
    background: #111827;
    padding: 35px;
    border-radius: 15px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    animation: fadeIn 0.6s ease-in-out;
}

/* label text */
p{
    margin-bottom: 15px;
    font-size: 14px;
    color: #cbd5e1;
}

/* inputs */
input, textarea{
    width: 100%;
    padding: 14px;
    margin-top: 12px;
    border: none;
    border-radius: 10px;
    background: #1e293b;
    color: white;
    font-size: 15px;
    outline: none;
    transition: 0.3s;
}

input:focus,
textarea:focus{
    border: 1px solid #38bdf8;
    box-shadow: 0 0 10px rgba(56,189,248,0.4);
}

/* textarea */
textarea{
    resize: none;
}

/* button */
button{
    width: 100%;
    margin-top: 20px;
    padding: 14px;
    background: #38bdf8;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #0f172a;
    cursor: pointer;
    transition: 0.3s;
}

button:hover{
    background: #0ea5e9;
    transform: translateY(-2px);
}

/* animation */
@keyframes fadeIn{
    from{
        opacity: 0;
        transform: translateY(20px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

/* mobile */
@media(max-width:600px){
    form{
        width: 90%;
        padding: 25px;
    }

    h2{
        font-size: 22px;
    }
}
</style>
<body>
    
<h2>Reply to Message</h2>
<div class="rep">
<form class="form" method="POST" action="send.php">

    <input type="hidden" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">

    <p><strong>To:</strong> <?php echo htmlspecialchars($data['email']); ?></p>

    <input type="text" name="subject" placeholder="Subject" required>

    <textarea name="message" rows="8" placeholder="Write your reply..." required></textarea>

    <button type="submit" name="send">Send Reply</button>

</form>
    </div>
</body>
</html>