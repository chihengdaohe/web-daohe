<?php

/**
 * Thrive Themes - https://thrivethemes.com
 *
 * @package thrive-dashboard
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Silence is golden!
}

class Thrive_Dash_Api_AWeber_EntryDataArray implements ArrayAccess, Countable, Iterator {
	private $counter = 0;

	protected $data;
	protected $keys;
	protected $name;
	protected $parent;

	public function __construct( $data, $name, $parent ) {
		$this->data   = $data;
		$this->keys   = array_keys( $data );
		$this->name   = $name;
		$this->parent = $parent;
	}

	public function count() {
		return sizeOf( $this->data );
	}

	#[\ReturnTypeWillChange]
	public function offsetExists( $offset ) {
		return ( isset( $this->data[ $offset ] ) );
	}

	public function offsetGet( $offset ) {
		return $this->data[ $offset ];
	}

	#[\ReturnTypeWillChange]
	public function offsetSet( $offset, $value ) {
		$this->data[ $offset ]       = $value;
		$this->parent->{$this->name} = $this->data;

		return $value;
	}

	#[\ReturnTypeWillChange]
	public function offsetUnset( $offset ) {
		unset( $this->data[ $offset ] );
	}

	public function rewind() {
		$this->counter = 0;
	}

	public function current() {
		return $this->data[ $this->key() ];
	}

	public function key() {
		return $this->keys[ $this->counter ];
	}

	public function next() {
		$this->counter ++;
	}

	public function valid() {
		if ( $this->counter >= sizeOf( $this->data ) ) {
			return false;
		}

		return true;
	}

	public function getData() {

		return $this->data;
	}
}
