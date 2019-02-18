<?php

namespace Tests\Unit;

use Tests\TestCase;

class StatsUpdateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStatsUpdate()
    {
        $mock = $this->getMockForTrait('App\Traits\UpdatesStreamData');

        $mockstats = array_fill(0, 720, [0, 100]);
        $expectedStats = array_fill(0, 719, [0, 100]);
        array_push($expectedStats, [1550179875000,300]);
        

        $cachedStreams = [[
            'thumbnail' => 'http://test',
            'url' => 'http://test',
            'display_name' => 'Test Stream',
            'name' => 'teststream',
            'id' => 1,
            'stats' => $mockstats
        ]];

        $newStreams = [[
            'viewers' => 300,
            'channel' => [
                '_id' => 1,
                'name' => 'teststream',
                'display_name' => 'Test Stream',
                'url' => 'http://test'
            ],
            'preview' => [
                'medium' => 'http://test'
            ]
        ]];

        $expectedStreams = collect([[
            'thumbnail' => 'http://test',
            'url' => 'http://test',
            'display_name' => 'Test Stream',
            'name' => 'teststream',
            'id' => 1,
            'stats' => $expectedStats
        ]]);

        $timestamp = 1550179875;

        $this->assertEquals($mock->updateStreamData($newStreams, $cachedStreams, $timestamp), $expectedStreams);
    }
}
