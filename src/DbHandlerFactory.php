<?php


namespace Intec\DbManager;


use Intec\DbManager\Exception\DbHandlerNotExistsException;
use PDO;
use PDOException;

class DbHandlerFactory
{

  protected static $instances = [];
  protected static $handlers = [];

  public static function registerDbHandler($handlerName, $host, $dbName, $dbUser, $dbPass, $dbCharset = 'utf8mb4')
  {
    self::$handlers[$handlerName] = [
      'host' => $host,
      'dbName' => $dbName,
      'dbUser' => $dbUser,
      'dbPass' => $dbPass,
      'dbCharset' => $dbCharset
    ];
  }


  public static function createDbHandler($handlerName)
  {
    if(array_key_exists($handlerName, self::$handlers) {
      if(!array_key_exists($handlerName, self::$instances)) {
        self::$instances[$handlerName] = new PDO(
              'mysql:host='. self::$handlers['host'] .';dbname='. self::$handlers['dbName'] .';charset=' . self::$handlers['dbCharset'],
              self::$handlers['dbUser'],
              self::$handlers['dbPass'],
              [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_PERSISTENT => false,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
              ]
          );
      }

      return self::$instances[$handlerName];
    }

    throw new DbHandlerNotExistsException();
  }

}
