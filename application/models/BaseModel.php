<?php

namespace Application\Models;

class BaseModel {

    private $_id;
    private $_attributes;

    public function __construct(array $attributes = []) {
        $this->_id         = isset($attributes['id']) ? $attributes['id'] : null;
        $this->_attributes = $attributes;
        unset($attributes['id']);
    }

    public function __get($name) {
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : null;
    }

    public function __set($name, $value) {
        return $this->_attributes[$name] = $value;
    }

    public function save() {
        if ($this->_id) {
            $assignments = array_map(function($attribute) { return $attribute . ' = ?'; }, static::ATTRIBUTES);
            $data        = array_map(function($attribute) { return $this->__get($attribute); }, static::ATTRIBUTES);
            $statement   = static::connection()->prepare('UPDATE'.static::TABLE.' SET '.join(', ', $assignments).' WHERE id = ?');
            $statement->execute($data);
        } else {
            $assignments = array_merge(['NULL'], array_map(function ($attribute) { return '?'; }, static::ATTRIBUTES));
            $data        = array_map(function ($attribute) { return $this->__get($attribute); }, static::ATTRIBUTES);
            $statement   = static::connection()->prepare('INSERT INTO ' . static::TABLE . ' VALUES(' . join(', ', $assignments).')');
            $statement->execute($data);
            $this->_id = static::connection()->lastInsertId();
        }
    }

    public function attributes() {
        return array_merge(['id' => $this->_id], $this->_attributes);
    }

    const TABLE      = null;
    const ATTRIBUTES = null;

    /**
     * @var \PDO
     */
    private static $_connection;

    /**
     * @return \PDO
     */
    public static function connection() {
        if (!self::$_connection) {
            self::$_connection = require_once(__DIR__.'/../config/database.php');
        }
        return self::$_connection;
    }
}