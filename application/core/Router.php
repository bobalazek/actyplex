<?php

class Router
{
    public $fragments = array();
	
	public function __construct()
	{
		$fragments = array();

		$fragmentsExplode = explode('/', CURRENT_URI_WITHOUT_QUERY_STRING);
		
		foreach( $fragmentsExplode as $fragment )
			if( $fragment != '' ) $fragments[] = $fragment;
		
		$this->fragments = $fragments;
	}
	
	public function fragment( $index = 0 )
	{
		if( array_key_exists( $index, $this->fragments ) ) return $this->fragments[$index];
		else return false;
	}
}