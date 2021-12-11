<?php

namespace Hyperf\Seata\SqlParser\Antlr\MySql;

use Hyperf\Seata\SqlParser\Antlr\SQLOperateRecognizerHolder;
use Hyperf\Seata\SqlParser\Core\SQLRecognizer;

class MySQLOperateRecognizerHolder implements SQLOperateRecognizerHolder
{

    public function getDeleteRecognizer(string $sql): SQLRecognizer
    {
        return new AntlrMySQLDeleteRecognizer($sql);
    }

    public function getInsertRecognizer(string $sql): SQLRecognizer
    {
        return new AntlrMySQLInsertRecognizer($sql);
    }

    public function getUpdateRecognizer(string $sql): SQLRecognizer
    {
        // TODO: Implement getUpdateRecognizer() method.
    }

    public function getSelectForUpdateRecognizer(string $sql): SQLRecognizer
    {
        // TODO: Implement getSelectForUpdateRecognizer() method.
    }
}