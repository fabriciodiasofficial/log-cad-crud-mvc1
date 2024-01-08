<!-- views/restricted_area.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Área Restrita do Usuário</title>
</head>
<body>
    <h2>Área Restrita do Usuário  -  <a href="index.php?q=view_profile">Visualizar Perfil</a></h2>
    <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
    
    <!-- Exibir produtos do usuário -->
    <?php if ($userProducts): ?>
        <h3>Seus Produtos:</h3>
        <table border="1">
            <tr>
                <th>Nome do Produto</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th> <!-- Nova coluna para ações -->
            </tr>
            <?php foreach ($userProducts as $product): ?>
                <tr>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>R$ <?php echo $product['price']; ?></td>
                    <td>
                        <a href="index.php?q=edit_product&id=<?php echo $product['id']; ?>">Editar</a>
                        <a href="index.php?q=delete_product&id=<?php echo $product['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                        <!-- Adicione links para outras ações, se necessário -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Você ainda não possui produtos.</p>
    <?php endif; ?>

    <!-- Adicionar link para a página de adição de produtos -->
    <p><a href="index.php?q=add_product">Adicionar Novo Produto</a></p>

    <a href="index.php?action=logout">Logout</a>
</body>
</html>
