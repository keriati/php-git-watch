<?php

class gitWatch
{

    private $config;

    function __construct($config = null)
    {
        if (null !== $config) {
            $this->config = $config;
            ob_start();
            print_r($config);
            $cfg = ob_get_clean();
            $this->gwLog('Config Dump: ' . $cfg, 3);
        } else {
            $this->gwLog('ERROR: Could not load config!');
            die('ERROR: Could not load config!');
        }
    }

    function processPayload($payload = null)
    {
        if ($payload === null) {
            $this->gwLog('ERROR: could not process payload!');
            return false;
        }

        $repository = $payload->repository->name;
        $branch     = $payload->branch;

        $this->gwLog('Repository: ' . $repository . ' Branch: ' . $branch, 3);

        if (!isset($this->config[$repository][$branch . '.enabled'])) {
            $this->gwLog('WARNING: ' . $branch . ' disabled!', 2);
            return true;
        }

        $folder      = $this->config[$repository][$branch . '.folder'];
        $keyLocation = $this->config[$repository][$branch . '.keyLocation'];

        $cmd = 'ssh-agent bash -c \'ssh-add ' . $keyLocation . ' && cd ' . $folder . ' && git pull\' >/dev/null 2>&1';

        $this->gwLog('Run Command: ' . $cmd, 3);

        shell_exec($cmd);

        $this->gwLog('Pulling ' . $repository . '/' . $branch . ' to ' . $folder, 0);

        return true;
    }

    private function gwLog($string, $l = 1)
    {
        if (GW_DEBUG >= $l) {
            $myDate = date('c');
            $file   = APP_PATH . '/log/gitwatch.log';
            $fh     = fopen($file, 'a');

            fwrite($fh, "\n" . $myDate . ' -> ' . $string);
            fclose($fh);

            return true;
        }
        return true;
    }
}