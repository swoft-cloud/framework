<?php

namespace Swoft\Db;

use Swoft\Core\RequestContext;
use Swoft\Db\Exception\MysqlException;
use Swoft\Db\Helper\DbHelper;
use Swoft\Pool\AbstractConnection;

/**
 * Abstract database connection
 */
abstract class AbstractDbConnection extends AbstractConnection implements DbConnectInterface
{

    /**
     *
     */
    public function fetch()
    {
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->pool->getDriver();
    }

    /**
     * Parse uri
     *
     * @param string $uri
     *
     * @return array
     * @throws MysqlException
     */
    protected function parseUri(string $uri): array
    {
        $parseAry = parse_url($uri);
        if (!isset($parseAry['host']) || !isset($parseAry['port']) || !isset($parseAry['path']) || !isset($parseAry['query'])) {
            throw new MysqlException('Uri format error uri=' . $uri);
        }
        $parseAry['database'] = str_replace('/', '', $parseAry['path']);
        $query                = $parseAry['query'];
        parse_str($query, $options);

        if (!isset($options['user']) || !isset($options['password'])) {
            throw new MysqlException('Lack of username and password，uri=' . $uri);
        }
        if (!isset($options['charset'])) {
            $options['charset'] = '';
        }

        $configs = array_merge($parseAry, $options);
        unset($configs['path'], $configs['query']);

        return $configs;
    }

    /**
     * @param string $sql
     */
    protected function pushSqlToStack(string $sql)
    {
        $contextSqlKey = DbHelper::getContextSqlKey();
        /* @var \SplStack $stack */
        $stack = RequestContext::getContextDataByKey($contextSqlKey, new \SplStack());
        $stack->push($sql);

        RequestContext::setContextDataByKey($contextSqlKey, $stack);
    }
}
