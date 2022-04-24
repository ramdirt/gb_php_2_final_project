<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    protected abstract static function getTableName();


    public function insert()
    {
        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == 'id' or $key == 'props') continue;
            $params[":" . $key] = $value;
            $columns[] = $key;
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));


        $tableName = static::getTableName();

        $sql = "INSERT INTO `{$tableName}`($columns) VALUES ($values)";
        echo $sql;
        echo '<br>';
        var_dump($params);

        echo '<br>';

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update()
    {
        //TODO сделать update в идеале оптимальный, формировать set только по изменившимся полям

        $request = '';

        foreach ($this as $key => $value) {
            if ($key == 'id' or $key == 'props') continue;
            if ($this->props[$key]) {
                if (is_numeric($value)) {
                    $request .= $key . ' = ' . $value;
                } else {
                    $request .= $key . ' = ' . '\'' . $value . '\'';
                }
                $request .= ' , ';
            }
        }
        $request = mb_substr($request, 0, -2);

        $tableName = static::getTableName();
        $sql = "UPDATE `{$tableName}` SET "  . $request . ' WHERE id = :id';
        Db::getInstance()->execute($sql, ['id' => $this->id]);
        return $this;
    }

    public function save()
    {
        //TODO реализовать умный save
        //if (???) $this->insert(); else $this->update();
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }

        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }



    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //  return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);
    }

    public static function getWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$name} = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
    }
}