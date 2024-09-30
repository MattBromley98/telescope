<?php

namespace Laravel\Telescope\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\Storage\EntryQueryOptions;
use Laravel\Telescope\Watchers\JobWatcher;

class QueueController extends EntryController
{
    /**
     * The entry type for the controller.
     *
     * @return string
     */
    protected function entryType()
    {
        return EntryType::JOB;
    }

    /**
     * Get an entry with the given ID.
     *
     * @param  \Laravel\Telescope\Contracts\EntriesRepository  $storage
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(EntriesRepository $storage, $id)
    {
        $entry = $storage->find($id);

        return response()->json([
            'entry' => $entry,
            'batch' => isset($entry->content['updated_batch_id'])
                            ? $storage->get(null, EntryQueryOptions::forBatchId($entry->content['updated_batch_id']))
                            : null,
        ]);
    }

    /**
     * Retries a entry with the given ID.
     */
    public function retry(Request $request)
    {
        $class = $request->get('jobType');
        $classInstance = new $class();

        $classInstance::deploy($request->get('payload'));

        return redirect()->to(route('/telescope/jobs'))->with('success', 'Successfully redeployed job');
    }

    /**
     * The watcher class for the controller.
     *
     * @return string
     */
    protected function watcher()
    {
        return JobWatcher::class;
    }
}
