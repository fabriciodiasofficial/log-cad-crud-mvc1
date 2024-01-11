<!-- models/UserModel.php -->
<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user'; // Defina o papel como 'user' por padrão
    
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':role', $role);
    
            $stmt->execute();
            return true; // Registro bem-sucedido
        } catch (PDOException $e) {
            echo "Erro ao registrar o usuário: " . $e->getMessage();
            return false;
        }
    }
    

    public function login($username, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao realizar o login: " . $e->getMessage();
            return false;
        }
    }

    public function getProducts($userId) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao obter produtos: " . $e->getMessage();
        return false;
    }
}

// Adicione esses métodos à classe UserModel

public function getProductById($productId, $userId) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao obter detalhes do produto: " . $e->getMessage();
        return false;
    }
}

public function updateProduct($productId, $userId, $productName, $description, $price) {
    try {
        $stmt = $this->conn->prepare("UPDATE products SET product_name = :product_name, description = :description, price = :price WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $productId);
        $stmt->bindParam(':user_id', $userId);

        $stmt->execute();
        return true; // Atualização bem-sucedida
    } catch (PDOException $e) {
        echo "Erro ao atualizar o produto: " . $e->getMessage();
        return false;
    }
}

// Adicione este método à classe UserModel

public function addProduct($userId, $productName, $description, $price) {
    try {
        $stmt = $this->conn->prepare("INSERT INTO products (user_id, product_name, description, price) VALUES (:user_id, :product_name, :description, :price)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);

        $stmt->execute();
        return true; // Adição bem-sucedida
    } catch (PDOException $e) {
        echo "Erro ao adicionar o produto: " . $e->getMessage();
        return false;
    }
}

// Adicione este método à classe UserModel

public function deleteProduct($productId, $userId) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $productId);
        $stmt->bindParam(':user_id', $userId);

        $stmt->execute();
        return true; // Exclusão bem-sucedida
    } catch (PDOException $e) {
        echo "Erro ao excluir o produto: " . $e->getMessage();
        return false;
    }
}

//Dados Pessoais do Usuário ############################

public function getUserData($userId) {
    try {
        $stmt = $this->conn->prepare("SELECT username, email, phone FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao obter os dados do usuário: " . $e->getMessage();
        return false;
    }
}

public function updateUserData($userId, $username, $email, $phone) {
    try {
        $stmt = $this->conn->prepare("UPDATE users SET username = :username, email = :email, phone = :phone WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();
        return true; // Atualização bem-sucedida
    } catch (PDOException $e) {
        echo "Erro ao atualizar os dados do usuário: " . $e->getMessage();
        return false;
    }
}



}
?>
