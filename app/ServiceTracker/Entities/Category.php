<?php namespace ServiceTracker\Entities;

class Category extends \Eloquent {
	protected $fillable = [];

	public function tickets()
    {
        return $this->hasMany('ServiceTracker\Entities\Ticket');
    }

    public function getPaginateTicketsAttribute()
    {
        return Ticket::where('category_id', $this->id)->paginate();
    }
}