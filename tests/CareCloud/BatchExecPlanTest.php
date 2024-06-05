<?php
namespace CareCloud;

use PHPUnit\Framework\TestCase;
use StarLei\Msuncloud\CareCloud\BatchExecPlan;
use StarLei\Msuncloud\CareCloud\BatchPatBaby;

class BatchExecPlanTest extends TestCase
{
    public function testHttpRequests()
    {
        $config = require(__DIR__.'/../Conf/config.php');
        $client = new BatchExecPlan($config);
        try {
            $data = [
                'patInHosIds'=>["6156808246982347000","6069876854083029256"],
                'updateBeginTime' => date('Y-m-d H:i:s', time() - 3599),
                'updateEndTime' => date('Y-m-d H:i:s', time()),
            ];
            var_dump($client->index($data,4901127357031780230));
        }catch (\Throwable $e){
            var_dump("失败:".$e->getMessage());
        }
    }
}