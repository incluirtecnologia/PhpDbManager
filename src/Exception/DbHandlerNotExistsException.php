<?php


namespace Intec\DbManager\Exception;


class DbHandlerNotExistsException extends Exception
{
  protected $message = 'DbHandler name not registered';
}
