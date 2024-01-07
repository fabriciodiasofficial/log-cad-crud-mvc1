<!-- views/edit_product.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    
    <form action="index.php?q=edit_product&id=<?php echo $productId; ?>" method="post">
        <label for="product_name">Nome do Produto:</label>
        <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required>
        <br>
        <label for="description">Descrição:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <br>
        <label for="price">Preço:</label>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required>
        <br>
        <input type="submit" value="Salvar Alterações">
    </form>
    
    <a href="index.php?q=restricted_area">Voltar para a Área Restrita</a>
</body>
</html>
