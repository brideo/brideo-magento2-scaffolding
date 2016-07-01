<?php

namespace Brideo\Magento2Scaffolding\Helper;

class TypeMapping
{

    const TYPE_BOOLEAN = 'boolean';
    const TYPE_SMALLINT = 'smallint';
    const TYPE_INTEGER = 'integer';
    const TYPE_BIGINT = 'bigint';
    const TYPE_FLOAT = 'float';
    const TYPE_NUMERIC = 'numeric';
    const TYPE_DECIMAL = 'decimal';
    const TYPE_DATE = 'date';
    const TYPE_TIMESTAMP = 'timestamp';
    const TYPE_DATETIME = 'datetime';
    const TYPE_TEXT = 'text';
    const TYPE_BLOB = 'blob';
    const TYPE_VARBINARY = 'varbinary';

    /**
     * A pretty hackie array.
     *
     * @var array
     */
    protected $types = [
        'bool' => self::TYPE_BOOLEAN,
        'int'  => self::TYPE_INTEGER,
        'string' => self::TYPE_TEXT,
        self::TYPE_BOOLEAN   => self::TYPE_BOOLEAN,
        self::TYPE_SMALLINT  => self::TYPE_SMALLINT,
        self::TYPE_INTEGER   => self::TYPE_INTEGER,
        self::TYPE_BIGINT    => self::TYPE_BIGINT,
        self::TYPE_FLOAT     => self::TYPE_FLOAT,
        self::TYPE_NUMERIC   => self::TYPE_NUMERIC,
        self::TYPE_DECIMAL   => self::TYPE_DECIMAL,
        self::TYPE_DATE      => self::TYPE_DATE,
        self::TYPE_TIMESTAMP => self::TYPE_TIMESTAMP,
        self::TYPE_DATETIME  => self::TYPE_DATETIME,
        self::TYPE_TEXT      => self::TYPE_TEXT,
        self::TYPE_BLOB      => self::TYPE_BLOB,
        self::TYPE_VARBINARY => self::TYPE_VARBINARY
    ];

    protected $staticBindings =  [
        self::TYPE_BOOLEAN   => 'Table::TYPE_BOOLEAN',
        self::TYPE_SMALLINT  => 'Table::TYPE_SMALLINT',
        self::TYPE_INTEGER   => 'Table::TYPE_INTEGER',
        self::TYPE_BIGINT    => 'Table::TYPE_BIGINT',
        self::TYPE_FLOAT     => 'Table::TYPE_FLOAT',
        self::TYPE_NUMERIC   => 'Table::TYPE_NUMERIC',
        self::TYPE_DECIMAL   => 'Table::TYPE_DECIMAL',
        self::TYPE_DATE      => 'Table::TYPE_DATE',
        self::TYPE_TIMESTAMP => 'Table::TYPE_TIMESTAMP',
        self::TYPE_DATETIME  => 'Table::TYPE_DATETIME',
        self::TYPE_TEXT      => 'Table::TYPE_TEXT',
        self::TYPE_BLOB      => 'Table::TYPE_BLOB',
        self::TYPE_VARBINARY => 'Table::TYPE_VARBINARY'
    ];

    /**
     * @param $type
     *
     * @return mixed
     * @throws \Exception
     */
    public function getStaticBinding($type)
    {
        if (!isset($this->staticBindings[$type])) {
            throw new \Exception("The type: {$type} does not exist.");
        }

        return $this->staticBindings[$type];
    }

    /**
     * @param string $input
     *
     * @return null|string
     */
    public function getInput($input)
    {
       if(!isset($this->types[$input])) {
           return null;
       }

        return $this->types[$input];
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }
}
