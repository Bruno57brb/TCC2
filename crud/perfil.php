<?php
session_start();
require_once "../function/conexao.php";
$conexao = conn();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Consulta para obter os dados do usuário logado
$stmt = $conn->prepare("SELECT conteudo FROM dados WHERE usuario_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row['conteudo']) . "</li>";
}
echo "</ul>";

$stmt->close();
$conn->close();
?>
<a href="logout.php">Logout</a>