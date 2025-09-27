<?php
$contraseña = "321dylan";
$hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
echo "Hash de contraseña segura: ". $hash_contraseña;
?>