<?php

namespace App\Console\Commands;

use App\Events\StatsUpdate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use TwitchApi;

class FetchStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streams:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stream stats and repopulate redis with new data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function fetchStreams()
    {
        $timestamp = time();

        $cachedStreams = json_decode(Redis::get('smashstreams:stats'), true);
        $lastFetch= (int)Redis::get('smashstreams:last-fetch');

        $ssbuStreams = TwitchApi::streams([
            'game' => 'Super Smash Bros. Ultimate',
        ]);

        $updatedStats = collect($ssbuStreams['streams'])->map(function($stream) use ($cachedStreams, $timestamp) {
            $pastStreamData = [];

            // Prepare a payload that can be used in the front end graphing lib
            $stats = [
                [
                    $timestamp * 1000,
                    $stream['viewers'],
                ],
            ];

            if ($cachedStreams !== null) {
                foreach($cachedStreams as $cachedStream) {
                    if ($stream['channel']['_id'] === $cachedStream['id']) {
                        // Only store the last 240 entries (60 minutes of data)
                        $stats = array_slice(array_merge($cachedStream['stats'], $stats), -240);
                        break;
                    }
                }
            }

            return [
                'stats' => $stats,
                'name' => $stream['channel']['display_name'],
                'id' => $stream['channel']['_id'],
            ];
        });

        Redis::set('smashstreams:stats', json_encode($updatedStats));
        Redis::set('smashstreams:last-fetch', $timestamp);

        // Triggers a websocket message with updated data
        event(new StatsUpdate($updatedStats));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* Laravel doesn't support scheduling in seconds, so 
         * this ugly sequence of sleeps can be used as a workaround. */
        foreach(range(1,4) as $iter) {
            $this->fetchStreams();
            sleep(15);
        }
    }
}
