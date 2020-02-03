<?php

declare(strict_types=1);

namespace Sabre\Event\BenchMark;

include __DIR__.'/../../../vendor/autoload.php';

abstract class BenchWildcard
{
    protected $startTime;
    protected $iterations = 10000;
    protected $totalTime;

    public function setUp(): void
    {
    }

    abstract public function test();

    public function go()
    {
        $this->setUp();
        $this->startTime = microtime(true);
        $this->test();
        $this->totalTime = microtime(true) - $this->startTime;

        return $this->totalTime;
    }
}

$tests = [
    'Sabre\Event\BenchMark\BenchWildcardOneCallBack',
    'Sabre\Event\BenchMark\BenchWildcardManyCallBacks',
    'Sabre\Event\BenchMark\BenchWildcardManyPrioritizedCallBacks',
];

foreach ($tests as $test) {
    $testObj = new $test();
    $result = $testObj->go();
    echo $test.' '.$result."\n";
}
