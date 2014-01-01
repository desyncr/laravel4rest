<?php
class Task extends Eloquent {
    /* HACK sqlite doesn't support BOOLEAN datatype, its represented as 0 or 1 */
    public function getCompletedAttribute($completed) {
        return (bool) $completed;
    }
}
