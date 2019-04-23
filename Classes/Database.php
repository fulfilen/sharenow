<?php 

class Database
{
	private static $_instance = null;
	private $_dbh,
			$_stmt,
			$_result,
			$_error = false,
			$_count = 0,
			$_lastInsertId,
			$_fetchColumn;

	private function __construct()
	{
		$options = [ PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

		try 
		{
			$this->_dbh = new PDO( 'mysql:host=' . Config::get('db/host') . '; dbname=' . Config::get('db/name'), Config::get('db/username'), Config::get('db/password'), $options);
		} 
		catch (PDOException $error) 
		{
			die('Error: ' . $error->getMessage() );
		}
	}

	public static function instance()
	{
		if ( is_null( self::$_instance )) 
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public function connection()
	{
		return $this->_dbh;
	}

	public function query( $sql, $params = [] )
	{
		$this->_errors = false;

		$this->_stmt = $this->_dbh->prepare( $sql );

		if ( count( $params ) ) 
		{
			$x = 1; 
			foreach ($params as $param) 
			{
				$this->_stmt->bindValue( $x, $param);

				$x++;
			}
		}

		if ($this->_stmt->execute()) 
		{
			if (explode(' ', $sql)[0] === 'SELECT') 
			{
				$this->_result = $this->_stmt->fetchAll();
				$this->_count = $this->_stmt->rowCount();
				$this->_fetchColumn = $this->_stmt->fetchColumn();
				
			}
			$this->_count = $this->_stmt->rowCount();
			$this->_insert_id = $this->_dbh->lastInsertId();
		}

		else
		{
			$this->_error = true;
			$this->_stmt->errorInfo();
		}

		return $this;
	}

	public function action($action, $table, array $where = null) 
	{
        if(count($where) === 3) 
        {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) 
            {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, [$value])->error()) 
                {
                    return $this;
                }
            }

        } else {
				
			$sql = "{$action} FROM {$table}";
			if(! $this->query($sql)->error()) {

				return $this;
			}
		}

        return false;
    }

    public function insert($table, $fields = array()) 
    {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;

        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(! $this->query($sql, $fields)->error()) 
        {
            return true;
        }

        return false;
    }
	
    public function update(string $table, int $id, array $fields) 
    {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) 
        {
            $set .= "{$name} = ?";
            if($x < count ($fields)) 
            {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()) 
        {
            return true;
        }

        return false;
    }


	public function delete($table, $where) 
	{
        return $this->action('DELETE ', $table, $where);
    }

    public function get($table, array $where = array()) 
    {

  //   	$sql = 'SELCT * FROM '. $table;

  //   	if (count($where)) {
			
		// 	foreach ($where as $key => $value) {
		// 		$sql .= ' WHERE ';
		// 	}
		// }



        if (isset($where)) {
			
			return $this->action('SELECT *', $table, $where);
		}

		return $this->action('SELECT *', $table);
    }

	public function resultSet()
	{
		return $this->_result;
	}

	public function result()
	{
		return $this->_result[0];
	}

	public function getColumn()
	{
		return $this->_fetchColumn;
	}

	public function rowCount()
	{
		return $this->_count;
	}

	public function error()
	{
		return $this->_error;
	}

	public function lastInsertId()
	{
		return $this->_insert_id;
	}
}







