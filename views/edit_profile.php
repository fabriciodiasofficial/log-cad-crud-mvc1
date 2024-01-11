<!-- views/edit_profile.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil do Usuário</title>
</head>
<body>
    <h2>Editar Perfil do Usuário</h2>

    <form action="index.php?q=edit_profile" method="post">
        <label for="username">Nome:</label>
        <input type="text" name="username" value="<?php echo $userData['username']; ?>" required>
        <br>
        <label for="email">E-mail:</label>
        <input type="email" name="email" value="<?php echo $userData['email']; ?>" required>
        <br>
        <label for="phone">Telefone:</label>
        <input type="text" name="phone" value="<?php echo $userData['phone']; ?>" required>
        <br>
        <input type="submit" value="Salvar Alterações">
    </form>

    <a href="index.php?q=restricted_area">Cancelar</a>
</body>
</html>
