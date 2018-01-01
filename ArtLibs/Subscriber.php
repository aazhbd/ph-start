<?php

namespace ArtLibs;


class Subscriber
{
    /**
     * @var string
     */
    public static $table_name = "subscribers";

    /**
     * @param Application $app
     * @param null $state
     * @return array|null
     */
    public static function getSubscribers(Application $app, $state = null)
    {
        $query = $app->getDataManager()->getDataManager()->from(Subscriber::$table_name);
        if (isset($state)) {
            $query = $query->where(array("state" => $state));
        }

        try {
            $q = $query->fetchAll();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $q;
    }

    /**
     * @param $subscriber_id
     * @param Application $app
     * @return null
     */
    public static function getSubscriberById($subscriber_id, Application $app)
    {
        try {
            $query = $app->getDataManager()->getDataManager()->from(Subscriber::$table_name)
                ->where(array("id" => $subscriber_id,))
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
    }

    /**
     * @param $subscriber_name
     * @param Application $app
     * @return null
     */
    public static function getSubscriberByName($subscriber_name, Application $app)
    {
        try {
            $query = $app->getDataManager()->getDataManager()->from(Subscriber::$table_name)
                ->where(array("name" => $subscriber_name))
                ->fetch();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return null;
        }

        return $query;
    }

    /**
     * @param array $subscriber
     * @param Application $app
     * @return bool|int
     * @throws \Exception
     */
    public static function addSubscriber($subscriber = array(), Application $app)
    {
        if (empty($subscriber)) {
            return false;
        }

        $subscriber['date_inserted'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->insertInto(Subscriber::$table_name)->values($subscriber);
            $executed = $query->execute();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        var_dump($executed);

        return $executed;
    }

    /**
     * @param $subscriber_id
     * @param array $subscriber
     * @param Application $app
     * @return bool|int|\PDOStatement
     */
    public static function updateSubscriber($subscriber_id, $subscriber = array(), Application $app)
    {
        if (empty($subscriber) || !isset($subscriber_id)) {
            return false;
        }

        $subscriber['date_updated'] = new \FluentLiteral('NOW()');

        try {
            $query = $app->getDataManager()->getDataManager()->update(Subscriber::$table_name, $subscriber, $subscriber_id);
            $executed = $query->execute();
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }

    /**
     * @param $state
     * @param $subscriber_id
     * @param Application $app
     * @return bool|int|\PDOStatement
     */
    public static function setState($state, $subscriber_id, Application $app)
    {
        if (!isset($state) || !isset($subscriber_id)) {
            return false;
        }

        try {
            $query = $app->getDataManager()->getDataManager()
                ->update(Subscriber::$table_name, array('state' => $state, 'date_updated' => new \FluentLiteral('NOW()')), $subscriber_id);
            $executed = $query->execute(true);
        } catch (\PDOException $ex) {
            $app->getErrorManager()->addMessage("Error : " . $ex->getMessage());
            return false;
        }

        return $executed;
    }
}

/**
 * An open source web application development framework for PHP 5.
 * @author        ArticulateLogic Labs
 * @author        Abdullah Al Zakir Hossain, Email: aazhbd@yahoo.com
 * @copyright     Copyright (c)2009-2014 ArticulateLogic Labs
 * @license       MIT License
 */
