<?php
//
// FILE: app\Models\Base.php
//

namespace App\Models;

/**
 * Base class for the CRUD on data.
 * Contains the 6 methods:
 *   - exists( $id )
 *   - add( $datas )
 *   - get( $id )
 *   - getAll()
 *   - update( $id, $datas )
 *   - delete( $id )
 */
class Base
{

  protected $tableName;
  // Class instance
  protected static $dbh;

  public function __construct()
  {
    if (!self::$dbh) {
      try {
        self::$dbh = new \PDO(
          'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
          DB_USER,
          DB_PASSWORD,
          [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
          ]
        );
      } catch (Exception $e) {
        trigger_error('Cannot connect to the base', E_USER_ERROR);
      }
    }
  }

  /**
   * Indicates whether the identifier already exists in the database.
   * @param integer $id identifier to test.
   * @return boolean
   */
  public function exists($id)
  {
    $sql = "SELECT COUNT(*) AS c FROM `{$this->tableName}` WHERE id = :id";
    $sth = self::$dbh->prepare($sql);
    $sth->bindValue(':id', $id);
    $sth->execute();
    return ($sth->fetch()['c'] > 0);
  }

  /**
   * Add the new information.
   * @param array $datas data to add.
   * @return integer
   */
  public function add($datas)
  {
    $sql = "INSERT INTO `" . $this->tableName . "` ( ";
    foreach (array_keys($datas) as $k) {
      $sql .= " {$k} ,";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " ) VALUE (";
    foreach (array_keys($datas) as $k) {
      $sql .= " :{$k} ,";
    }
    $sql = substr($sql, 0, strlen($sql) - 1) . " )";
    $sth = self::$dbh->prepare($sql);
    foreach (array_keys($datas) as $k) {
      $sth->bindValue(':' . $k, $datas[$k]);
    }
    $sth->execute();
    return self::$dbh->lastInsertId();
  }

  /**
   * Edit the information of an identifier.
   * @param integer $id identifier to modify.
   * @param integer $datas associative array of data.
   * @return integer
   */
  public function update($id, $datas)
  {
    $sql = "UPDATE `" . $this->tableName . "` SET ";
    foreach (array_keys($datas) as $k) {
      $sql .= " {$k} = :{$k} ,";
    }
    $sql = substr($sql, 0, strlen($sql) - 1);
    $sql .= " WHERE id =:id";
    $sth = self::$dbh->prepare($sql);
    foreach (array_keys($datas) as $k) {
      $sth->bindValue(':' . $k, $datas[$k]);
    }
    $sth->bindValue(':id', $id);
    return $sth->execute();
  }

  /**
   * Returns the information of an identifier.
   * @param integer $id identifier.
   * @return array
   */
  public function get($id)
  {
    $sql = "SELECT * FROM `{$this->tableName}` WHERE id = :id";
    $sth = self::$dbh->prepare($sql);
    $sth->bindValue(':id', $id);
    $sth->execute();
    return $sth->fetch();
  }

  /**
   * Retourne toutes les informations.
   * @return array
   */
  public function getAll()
  {
    $sql = "SELECT * FROM `{$this->tableName}`";
    return self::$dbh->query($sql)->fetchAll();
  }

  /**
   * Erase the identifier.
   * @param  integer  $id identifier.
   * @return int|boolean
   */
  public function delete($id)
  {
    $sql = "DELETE FROM `{$this->tableName}` WHERE id = :id";
    $sth = self::$dbh->prepare($sql);
    $sth->bindValue(':id', $id);
    return $sth->execute();
  }
}
