<!-- controller/AuthController.php -->
<?php
class AuthController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->userModel->register($_POST['username'], $_POST['password'], $_POST['role']);
            
            if ($result) {
                // Registro bem-sucedido
                session_start();
                $_SESSION['registration_success'] = "Usuário registrado com sucesso! Agora você pode fazer o login.";
                header("Location: index.php?q=login");
                exit();
            } else {
                echo "Erro ao registrar o usuário.";
            }
        }
        require_once 'views/register.php';
    }

    public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userModel->login($username, $password);

        if ($user) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id']; // Adicione esta linha para armazenar o 'user_id'
            $_SESSION['role'] = $user['role'];
            $this->redirectToRoleSpecificPage($user['role']);
        } else {
            echo "Senha ou usuário incorreto.";
        }
    }
    require_once 'views/login.php';
}


    public function restrictedArea() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?q=login");
            exit();
        }

        // Obtenha o ID do usuário
        $userId = $_SESSION['user_id'];

        // Obtenha os produtos do usuário
        $userProducts = $this->userModel->getProducts($userId);

        // Verifica o papel do usuário
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        if ($role == 'admin') {
            // Página específica para administradores
            require_once 'views/restricted_area_admin.php';
        } elseif ($role == 'manager') {
            // Página específica para gerentes
            require_once 'views/restricted_area_manager.php';
        } else {
            // Página padrão para usuários comuns
            require_once 'views/restricted_area.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?q=login");
        exit();
    }

    private function redirectToRoleSpecificPage($role) {
        if ($role == 'admin') {
            header("Location: index.php?q=restricted_area");
        } elseif ($role == 'manager') {
            header("Location: index.php?q=restricted_area");
        } else {
            header("Location: index.php?q=restricted_area");
        }
        exit();
    }

    // Adicione este método à classe AuthController

public function editProduct() {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: index.php?q=login");
        exit();
    }

    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $productId = $_GET['id'];
        $product = $this->userModel->getProductById($productId, $userId);

        if ($product) {
            require_once 'views/edit_product.php';
        } else {
            echo "Produto não encontrado.";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
        $productId = $_GET['id'];
        $productName = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $result = $this->userModel->updateProduct($productId, $userId, $productName, $description, $price);

        if ($result) {
            echo "Produto atualizado com sucesso!";
            // Redirecione para a área restrita ou para onde for apropriado
        } else {
            echo "Erro ao atualizar o produto.";
        }
    } else {
        echo "Ação inválida.";
    }
}

// Adicione este método à classe AuthController

public function addProduct() {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: index.php?q=login");
        exit();
    }

    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productName = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $result = $this->userModel->addProduct($userId, $productName, $description, $price);

        if ($result) {
            echo "Produto adicionado com sucesso!";
            // Redirecione para a área restrita ou para onde for apropriado
        } else {
            echo "Erro ao adicionar o produto.";
        }
    } else {
        require_once 'views/add_product.php';
    }
}
// Adicione este método à classe AuthController

public function deleteProduct() {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: index.php?q=login");
        exit();
    }

    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $productId = $_GET['id'];

        $result = $this->userModel->deleteProduct($productId, $userId);

        if ($result) {
            echo "Produto excluído com sucesso!";
            // Redirecione para a área restrita ou para onde for apropriado
        } else {
            echo "Erro ao excluir o produto.";
        }
    } else {
        echo "Ação inválida.";
    }
}



}
?>
