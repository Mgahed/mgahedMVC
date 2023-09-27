<?php

namespace App\Models;

use MgahedMvc\Support\Str;

abstract class Model
{
    protected static $instance;

    public static function create(array $attributes)
    {
        self::$instance = static::class;

        return app()->db->create($attributes);
    }

    public static function all()
    {
        self::$instance = static::class;
//        return self::getTableName();

        return app()->db->read();
    }

    public static function where($filter, $column = '*')
    {
        self::$instance = static::class;

        return app()->db->read($column, $filter);
    }

    public static function find($id)
    {
        self::$instance = static::class;

        return app()->db->read('*', ['id', '=', $id]);
    }

    public static function update($id, $data)
    {
        self::$instance = static::class;

        return app()->db->update($id, $data);
    }

    public static function delete($id)
    {
        self::$instance = static::class;

        return app()->db->delete($id);
    }

    public static function getModel()
    {
        return self::$instance;
    }

    public static function getTableName()
    {
        return strtolower(Str::plural(class_basename(self::$instance)));
    }
}