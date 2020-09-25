<?php

namespace Facilitador\Http\Controllers\Admin;

use Facilitador\Exceptions\Exception;
use Support\Models\Worker;
use Illuminate\Http\Request;


/**
 * Check the status of workers from the admin
 */
class Workers extends Base
{
    /**
     * @var string
     */
    public $description = "Monitor whether workers are running or not. The logic of a failed worker is still executed regularly, just at a slower interval.";

    /**
     * Display all the workers
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        return $this->populateView(
            'facilitador::tools.workers.index', [
            'workers' => Worker::all(),
            ]
        );
    }

    /**
     * Ajax service that tails the log file for the selected worker
     *
     * @param $worker
     */
    public function tail($worker)
    {
        // Form the path to the file
        $file = Worker::logPath(urldecode($worker));
        if (!file_exists($file)) {
            throw new Exception('Log not found: '.$file);
        }
        $size = 1024 * 100; // in bytes to get

        // Read from the end of the file
        clearstatcache();
        $fp = fopen($file, 'r');
        fseek($fp, -$size, SEEK_END);
        $contents = explode("\n", fread($fp, $size));
        fclose($fp);

        // Reverse the contents and return
        $contents = array_reverse($contents);
        if (empty($contents[0])) {
            array_shift($contents);
        }
        die(implode("\n", $contents));
    }
}
