<!-- views/add_product.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Produto</title>
</head>
<body>
    <h2>Adicionar Produto</h2>
    
    <form action="index.php?q=add_product" method="post">
        <label for="product_name">Nome do Produto:</label>
        <input type="text" name="product_name" required>
        <br>
        <label for="description">Descrição:</label>
        <textarea name="description" required></textarea>
        <br>
        <label for="price">Preço:</label>
        <input type="text" name="price" required>
        <br>
        <input type="submit" value="Adicionar Produto">
    </form>
    
    <a href="index.php?q=restricted_area">Voltar para a Área Restrita</a>
</body>
</html>
