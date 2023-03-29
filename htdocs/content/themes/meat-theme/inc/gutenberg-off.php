<?php

use Themosis\Support\Facades\Filter;

$enable = env('ENABLE_GUTEMBER', true);
if ($enable) {
    Filter::add('use_block_editor_for_post', '__return_true', 10);
} else {
    Filter::add('use_block_editor_for_post', '__return_false', 10);
}
