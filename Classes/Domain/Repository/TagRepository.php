<?php

/* * *************************************************************
 * Copyright notice
 *
 * (c) 2011 by Tim Lochmüller / HDNET
 *
 * All rights reserved
 *
 * This script is part of the Caretaker project. The Caretaker project
 * is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

class Tx_Tagger_Domain_Repository_TagRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Get Objects by random
	 * 
	 * @param int $count
	 * @return Tx_Extbase_Persistence_QueryResultInterface|array
	 */
	public function findRandom($count = 1) {
		$rows = $this->createQuery()->execute()->count();
		$row_number = mt_rand(0, max(0, ($rows - $count)));
		return $this->createQuery()->setOffset($row_number)->setLimit($count)->execute();
	}

	/**
	 * Get Objects by uids
	 * 
	 * @param array $ids
	 * @return Tx_Extbase_Persistence_QueryResultInterface|array
	 */
	public function findByUids($ids) {
		$query = $this->createQuery();
		$query->matching($query->in('uid', $ids));
		return $query->execute();
	}

}