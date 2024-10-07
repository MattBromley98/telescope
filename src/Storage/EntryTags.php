<?php

namespace Laravel\Telescope\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EntryTags extends Model
{
    public $table = 'telescope_entry_tags';

    public function job(): HasOne
    {
        return $this->hasOne(EntryModel::class, 'uuid', 'entry_id');
    }
}
