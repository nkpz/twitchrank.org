<?php

namespace App\Traits;

trait UpdatesStreamData
{
    public function updateStreamData($newStreams, $cachedStreams, $timestamp)
    {
        return collect($newStreams)->map(function ($stream) use ($cachedStreams, $timestamp) {
            $pastStreamData = [];

            // Prepare a payload that can be used in the front end graphing lib
            $stats = [
                [
                    $timestamp * 1000,
                    $stream['viewers'],
                ],
            ];

            if ($cachedStreams !== null) {
                foreach ($cachedStreams as $cachedStream) {
                    if ($stream['channel']['_id'] === $cachedStream['id']) {
                        // Only store the last 240 entries (2 hours of data)
                        $stats = array_slice(array_merge($cachedStream['stats'], $stats), -1 * env('MIX_MAX_RECORDS', 720));
                        break;
                    }
                }
            }

            return [
                'stats' => $stats,
                'display_name' => $stream['channel']['display_name'],
                'name' => $stream['channel']['name'],
                'id' => $stream['channel']['_id'],
                'url' => $stream['channel']['url'],
                'thumbnail' => $stream['preview']['medium'],
            ];
        });
    }
}
