<?php
/**
 * clase que proporciona métodos para conectarse a una base de datos y ejecutar instrucciones SQL
 * @category Database
 * @package  Database
 */
class Database
{
    /**
     * El nombre del host de la base de datos.
     * 
     * @var string
     */
    private $host;

    /**
     * El nombre de usuario de la base de datos.
     * 
     * @var string
     */
    private $usuario;

    /**
     * La contraseña del usuario de la base de datos.
     * 
     * @var string
     */
    private $pass;

    /**
     * El nombre de la base de datos.
     * 
     * @var string
     */
    private $db;

    /**
     * La conexión a la base de datos.
     * 
     * @var PDO
     */
    private $connection;

    /**
     * Constructor de la clase. Define los parámetros de conexión a la base de datos.
     */
    function __construct()
    {
        $this->host = HOST_NAME;
        $this->usuario = US_NAME;
        $this->pass = PSSWORD;
        $this->db = DB_NAME;
    }

    /**
     * Conecta a la base de datos utilizando PDO.
     * 
     * @throws Exception Si hay un error en la conexión.
     * @return void
     */
    function connect()
    {

        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );

        $this->connection = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->db,
                $this->usuario,
                $this->pass,
            $opciones
        );
    }
    
    /**
     * Obtiene los datos de una consulta SQL.
     * 
     * @param string $sql La consulta SQL a ejecutar.
     * @throws Exception Si hay un error en la consulta.
     * @return array Los datos obtenidos de la consulta.
     */
    function getData($sql)
    {

        $data = array();
        $result = $this->connection->query($sql);

        $error = $this->connection->errorInfo();
        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    array_push($data, $row);
                }
            }
        } else {
            throw new Exception($error[2]);
        }
        return $data;
    }

    /**
     * Obtiene el número de filas que devuelve una consulta SQL
     * 
     * @param string $sql Consulta SQL a ejecutar.
     * @return int Número de filas que devuelve la consulta.
     * @throws Exception Si ocurre un error al ejecutar la consulta.
     */
    function numRows($sql)
    {
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount();
        } else {
            throw new Exception($error[2]);
        }
    }

    /**
     * Obtiene la primera fila que devuelve una consulta SQL.
     * 
     * @param string $sql Consulta SQL a ejecutar.
     * @return array|null Array asociativo con los valores de la primera fila, o null si la consulta no devuelve filas.
     * @throws Exception Si ocurre un error al ejecutar la consulta
     */
    function getDataSingle($sql)
    {

        $result = $this->connection->query($sql);

        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    /**
     * Obtiene el valor de una propiedad de la primera fila que devuelve una consulta SQL.
     * 
     * @param string $sql Consulta SQL a ejecutar.
     * @param string $prop Nombre de la propiedad a obtener
     * @return mixed Valor de la propiedad, o null si la consulta no devuelve filas
     * @throws Exception Si ocurre un error al ejecutar la consulta.
     */
    function getDataSingleProp($sql, $prop)
    {

        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            if ($result->rowCount() > 0) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data[$prop];
            }
        } else {
            throw new Exception($error[2]);
        }
        return null;
    }

    /**
     * Ejecuta una instrucción SQL que no devuelve filas
     * 
     * @param string $sql Instrucción SQL a ejecutar.
     * @return bool true si la instrucción se ejecutó correctamente, false de lo contrario.
     * @throws Exception Si ocurre un error al ejecutar la instrucción.
     */
    function executeInstruction($sql)
    {
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();

        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount() > 0;
        } else {
            throw new Exception($error[2]);
        }
    }

    /**
     * Inserta un registro en una tabla especificada.
     * 
     * @param string $table Nombre de la tabla donde insertar el registro.
     * @param array $arrayValues Array asociativo con los valores del registro a insertar.
     * @return bool true si el registro se insertó correctamente, false de lo contrario.
     * @throws Exception Si ocurre un error al ejecutar la consulta.
     */
    function insert($table, $arrayValues)
    {
        $arrayKeyValues = array_keys($arrayValues);
        $keys = $arrayKeyValues[0];
        $keysValues = ":" . $arrayKeyValues[0];

        for ($i = 1; $i < count($arrayValues); $i++) {
            $keys .= ", " . $arrayKeyValues[$i];
            $keysValues .= ", :" . $arrayKeyValues[$i];
        }
        $result = $this->connection->prepare("INSERT INTO $table ($keys) VALUES ($keysValues)");

        for ($i = 0; $i < count($arrayValues); $i++) {
            $result->bindparam(':' . $arrayKeyValues[$i], $arrayValues[$arrayKeyValues[$i]]);
        }
        $error = $this->connection->errorInfo();
        if ($error[0] === "00000") {
            $result->execute();
            return $result->rowCount() > 0;
        } else {
            throw new Exception($error[2]);
        }
    }
    
    /**
     * Cierra la conexión con la base de datos.
     * 
     * @return void
     */
    function close()
    {
        $this->connection = null;
    }

    /**
     * Obtiene el último ID insertado en la base de datos.
     * 
     * @return string El último ID insertado.
     */
    function getLastId()
    {
        return $this->connection->lastInsertId();
    }
}
?>