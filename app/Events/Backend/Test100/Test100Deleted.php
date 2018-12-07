<?php namespace App\Events\Backend\Test100;

use Illuminate\Queue\SerializesModels;
/**
 * Class Test100Deleted.
 */

class Test100Deleted
{
    use SerializesModels;
    /**
     * @var
     */

    public $test100;

    /**
     * @param $test100
     */
    public function __construct($test100)
    {
        $this->test100 = $test100;
    }
}
