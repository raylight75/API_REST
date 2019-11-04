<?php
include('connection/ConnectionDB.php');

/**
 * Client class verify what method was sent and execute the respective method.
 */
class Client
{
    //Attributes
    private $id;
    private $google;
    private $positive;
    private $facebook;
    private $db;
    private $method;

    /**
     * Client constructor.
     * @param string $name
     * @param string $age
     * @param string $gender
     */
    function __construct($google = '', $positive = '', $facebook = '')
    {
        # Construct the class and set the values in the attributes.
        $this->db = ConnectionDB::getInstance();
        $this->google = $google;
        $this->positive = $positive;
        $this->facebook = $facebook;
    }

    /**
     * @param $method
     * @param $route
     * @return array
     */
    function verifyMethod($method, $route)
    {
        //Verifies what is the method sent.
        switch ($method) {
            case 'GET':
                # When the method is GET, returns the client
                return self::doGet($route);
                break;
            case 'POST':
                # When the method is POST, includes a new client
                if (empty($route[1])) {
                    return self::doPost();
                } else {
                    return $arr_json = array('status' => 404);
                }
                break;
            case 'PUT':
                # When the method is PUT, alters an existing client
                return self::doPut($route);
                break;
            case 'DELETE':
                # When the method is DELETE, excludes an existing client.
                return self::doDelete($route);
                break;
            default:
                # When the method is different of the previous methods, return an error message.
                return array('status' => 405);
                break;
        }
    }

    /**
     * @param $route
     * @return array
     */
    function doGet($route)
    {
        //GET method
        $sql = 'SELECT * FROM api.client WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $route[1]);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $arr_json = array('status' => 200, 'client' => $row);
        } else {
            return $arr_json = array('status' => 404);
        }
    }

    /**
     * @return array
     */
    function doPost()
    {
        //POST method
        $sql = 'INSERT api.client (analytics,positive,facebook) VALUES (:analytics,:positive,:facebook)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':analytics', $this->google);
        $stmt->bindValue(':positive', $this->positive);
        $stmt->bindValue(':facebook', $this->facebook);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $arr_json = array('status' => 200);
        } else {
            return $arr_json = array('status' => 400);
        }

    }

    /**
     * @param $route
     * @return array
     */
    function doPut($route)
    {
        //PUT method
        $sql = 'UPDATE api.client 
                SET analytics = :analytics, 
                       positive = :positive, 
                       facebook = :facebook
                WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':analytics',$this->google);
        $stmt->bindValue(':positive', $this->positive);
        $stmt->bindValue(':facebook', $this->facebook);
        $stmt->bindValue(":id", $route[1]);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $arr_json = array('status' => 200);
        } else {
            return $arr_json = array('status' => 400);
        }

    }

    /**
     * @param $route
     * @return array
     */
    function doDelete($route)
    {
        //DELETE method
        $sql = 'DELETE FROM api.client WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $route[1]);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $arr_json = array('status' => 200);
        } else {
            return $arr_json = array('status' => 400);
        }
    }
}

?>