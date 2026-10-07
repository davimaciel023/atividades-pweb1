<?php
setcookie("usuario_logado", "true", time() + 3600);
header("Location: dashboard.php");
exit;
