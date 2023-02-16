<?PHP
/**
 * La clase User_model extiende la clase Database y provee métodos para interactuar con la tabla 'user'.
 */
class User_model extends Database
{
    /**
     * Obtiene el id de un usuario activo en base a su email y contraseña.
     *
     * @param string $email    El email del usuario.
     * @param string $password La contraseña del usuario.
     *
     * @return mixed Retorna el id del usuario si se encuentra uno activo que coincida con las credenciales provistas, de lo contrario retorna NULL.
     */
    function getUserActive($email, $password)
    {
        try {
            $this->connect();
            $sql = "SELECT id FROM user WHERE email = '$email' AND clave = '$password' AND activo = 1";
            $result = $this->getDataSingle($sql);
            $this->close();
            return $result;
        } catch (\Throwable $th) {
        }
    }

    /**
     * Guarda un nuevo usuario en la tabla 'user'.
     *
     * @param string $nom    El nombre del usuario.
     * @param string $emal   El email del usuario.
     * @param string $clave  La contraseña del usuario.
     *
     * @return mixed Retorna el id del usuario creado, de lo contrario retorna false.
     */
    public function saveUser($nom, $emal, $clave)
    {
        try {
            $this->connect();
            $l = $this->insert('user', array(
                'clave' => $clave,
                'email' => $emal,
                'nom' => $nom,
                'activo' => true
            )
            );
            $id = $this->getLastId();
            $this->close();
            return ($l) ? $id : false;
        } catch (\Throwable $th) {
        }
    }
}

?>