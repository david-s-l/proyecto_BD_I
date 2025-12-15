<?php

class Controller {

    protected $layout = 'layout';  // carpeta layout dentro de /views
    protected $data = [];

    public function __construct() {
        // Aquí puedes verificar sesiones si deseas
    }

    /**
     * Renderiza una vista usando el layout
     */
    protected function render($view, $data = []) {

        $this->data = array_merge($this->data, $data);
        extract($this->data);

        $viewFile = 'views/' . $view . '.php';

        $header = 'views/' . $this->layout . '/header.php';
        $sidebar = 'views/' . $this->layout . '/sidebar.php';
        $footer = 'views/' . $this->layout . '/footer.php';

        if (file_exists($header)) include $header;
        if (file_exists($sidebar)) include $sidebar;

        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "<h3 style='color:red;'>Vista no encontrada: $viewFile</h3>";
        }

        if (file_exists($footer)) include $footer;
    }

    /**
     * Carga un modelo
     */
    protected function loadModel($model) {
        $file = 'models/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            if (class_exists($model)) return new $model();
        }
        return null;
    }

    /**
     * Redirigir a una ruta del sistema
     */
    protected function redirect($path) {
        header("Location: " . base_url . $path);
        exit();
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function post($key, $default = null) {

        if (!isset($_POST[$key])) {
            return $default;
        }

        $value = $_POST[$key];

        // Si es array (roles[], etc.) → devolver tal cual
        if (is_array($value)) {
            return array_map(function ($item) {
                return is_string($item) ? trim($item) : $item;
            }, $value);
        }

        // Si es string → trim
        if (is_string($value)) {
            return trim($value);
        }

        return $value;
    }

    protected function get($key, $default = null) {

        if (!isset($_GET[$key])) {
            return $default;
        }

        $value = $_GET[$key];

        // GET puede traer arrays, ej: ?ids[]=1&ids[]=2
        if (is_array($value)) {
            return array_map(function ($item) {
                return is_string($item) ? trim($item) : $item;
            }, $value);
        }

        return is_string($value) ? trim($value) : $value;
    }

    protected function request($key, $default = null) {

        if (isset($_POST[$key])) {
            return $this->post($key, $default);
        }

        if (isset($_GET[$key])) {
            return $this->get($key, $default);
        }

        return $default;
    }

    protected function file($key) {
        return $_FILES[$key] ?? null;
    }

    protected function checkbox($key) {
        return isset($_POST[$key]) ? 1 : 0;
    }

    protected function clean($string) {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Log de operaciones para auditoría
     */
    protected function addLog($tabla, $operacion, $descripcion) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO log_sistema(tabla, operacion, descripcion) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $tabla, $operacion, $descripcion);
            $stmt->execute();
        } catch (Exception $e) {
            // Evitar romper el sistema si el log falla
        }
    }
}
