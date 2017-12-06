<?php

/**
 * @author   Luiz Felipe Magalhães Galindo <lfgalindo@live.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('add_fk') ) {
	/**
	 * @param string $table
	 * @param string $fk
	 * @param string $references
	 * @param string $on_delete
	 * @param string $on_update
	 *
	 * @return string SQL command
	 */
	function add_fk($table, $fk, $references, $on_delete = 'RESTRICT', $on_update = 'RESTRICT') {
		$sql = "ALTER TABLE {$table} ADD INDEX `parent` (`parent`);";
		$constraint = "{$table}_{$fk}_fk";
		$sql .= "ALTER TABLE {$table} ADD CONSTRAINT {$constraint} FOREIGN KEY ({$fk}) REFERENCES {$references} ON DELETE {$on_delete} ON UPDATE {$on_update}";
		return $sql;
	}
}

if ( ! function_exists('drop_fk') ) {
	/**
	 * @param string $table
	 * @param string $fk
	 *
	 * @return string SQL command
	 */
	function drop_fk($table, $fk)	{
		$constraint = "{$table}_{$fk}_fk";
		$sql = "ALTER TABLE {$table} DROP FOREIGN KEY {$constraint}; ";
		$sql .= "DROP INDEX {$constraint} ON {$table}";
		return $sql;
	}
}