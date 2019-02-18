<?php

namespace App\Console\Commands;

use App\Events\StatsUpdate;
use App\Traits\UpdatesStreamData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use TwitchApi;

class FetchStreams extends Command
{
    use UpdatesStreamData;

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

    private function updateStreams(array $ssbuStreams)
    {
        $timestamp = time();

        $cachedStreams = json_decode(Redis::get('smashstreams:stats'), true);

        $updatedStats = $this->updateStreamData($ssbuStreams['streams'], $cachedStreams, $timestamp);
        Redis::set('smashstreams:stats', json_encode($updatedStats));
        Redis::set('smashstreams:last-fetch', $timestamp);

        // Triggers a websocket message with updated data
        event(new StatsUpdate($updatedStats));
    }

    private function twitchRequest(): array
    {
        return TwitchApi::streams([
            'game' => 'Super Smash Bros. Ultimate',
        ]);
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
        foreach (range(1, 6) as $iter) {
            $ssbuStreams = $this->twitchRequest();
            $this->updateStreams($ssbuStreams);
            sleep(10);
        }
    }
}
