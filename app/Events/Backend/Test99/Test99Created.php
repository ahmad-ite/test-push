<?php
namespace App\Events\Backend\Test99;

use Illuminate\Queue\SerializesModels;
/**
 * Class Test99Created.
 */
class Test99Created
{
    use SerializesModels;
    /**
     * @var
     */

    public $test99;

    /**
     * @param $test99
     */
    public function __construct($test99)
    {
        $this->test99 = $test99;
    }
}
