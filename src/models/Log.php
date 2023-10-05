<?php

namespace models;

/**
 * Manages and records activity to a log file.
 *
 * This class provides a mechanism to track and log specific actions
 * performed within the application, recording essential details like
 * the user, action, IP address, result, and timestamp.
 */
class Log
{
    /**
     * The path to the log file where entries will be recorded.
     *
     * @var string
     */
    protected string $logPath = __DIR__ . '/../log/log.txt';

    /**
     * Records a specific action and its details into the log file.
     *
     * The log entry will include information such as the user who
     * performed the action, their IP address, the action itself,
     * the result of the action, and the timestamp.
     *
     * @param string $action The action that was performed.
     * @param string $user The user (or entity) that performed the action.
     * @param string $ip The IP address of the user.
     * @param string $result The outcome or result of the action (e.g., success, failure).
     * @return void
     */
    public function actionLog(string $action, string $user, string $ip, string $result): void
    {
        $data = $user . ' with IP: ' . $ip
            . ' performed the action: ' . $action
            . ' with result: ' . $result
            . ' on date: ' . date('l jS \of F Y h:i:s A')
            . PHP_EOL;

        file_put_contents($this->logPath, $data, FILE_APPEND);
    }
}
