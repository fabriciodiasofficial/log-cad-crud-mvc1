<!-- views/profile.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Perfil do Usuário</title>
</head>
<body>
    <h2>Perfil do Usuário  -  <a href="index.php?q=edit_profile">Editar Perfil</a></h2>

    <p><strong>Nome:</strong> <?php echo $userData['username']; ?></p>
    <p><strong>E-mail:</strong> <?php echo $userData['email']; ?></p>
    <p><strong>Telefone:</strong> <?php echo $userData['phone']; ?></p>

    <a href="index.php?q=restricted_area">Voltar para a Área Restrita</a>
</body>
</html>
