<?php

class Paginator {
	static public $wantCount = 1;
	static public $table;
	static public $textPag;

	static public function builder($str = '', $cat = '') {
		if ($str == '') {
			$res = q("
					SELECT SQL_CALC_FOUND_ROWS *
					FROM `".self::$table."`
					");
		} else {
			$res = q("
					SELECT SQL_CALC_FOUND_ROWS *
					FROM `".self::$table."`
					".$str."
					");
		}
		$countItems = $res->num_rows;
		$res->close();

		$resPages = $countItems%self::$wantCount;
		if (!$resPages) {
			$resPages = $countItems/self::$wantCount;
			if ($resPages <= 1) {
				return '';
			}
		} else {
			$resPages = $countItems/self::$wantCount;
			if ($resPages <= 1) {
				return '';
			} else {
				$resPages = (int)($countItems/self::$wantCount) + 1;
			}
		}

		if (isset($_GET['p']) && $_GET['p'] > $resPages) {
			$_GET['p'] = $resPages;
		} elseif (isset($_GET['p']) && $_GET['p'] < 1) {
			$_GET['p'] = 1;
		} elseif (isset($_GET['p'])) {
			$_GET['p'] = (int)$_GET['p'];
		}

		if ($cat != '') {
			$getCat = 'category='.$cat.'&';
		} else {
			$getCat = '';
		}

		if (isset($_GET['p']) && $_GET['p'] != 1) {
			if ($_GET['p'] == $resPages) {
				$after = '<span style="margin: 0 2px">></span>';
			} else {
				$after = '<a href="?'.$getCat.'p='.($_GET['p'] + 1).'" style="margin: 0 2px">></a>';
			}
			$before = '<a href="?'.$getCat.'p='.($_GET['p'] - 1).'" style="margin: 0 2px"><</a>';
		} else {
			$before = '<span style="margin: 0 2px"><</span>';
			$after = '<a href="?'.$getCat.'p=2" style="margin: 0 2px">></a>';
		}

		self::$textPag .= $before;

		for ($i = 1; $i <= $resPages; $i++) {
			if (!isset($_GET['p']) && $i == 1) {
				self::$textPag .= '<span style="margin: 0 2px">'.$i.'</span>';
			} elseif (isset($_GET['p']) && $_GET['p'] == $i) {
				self::$textPag .= '<span style="margin: 0 2px">'.$i.'</span>';
			} elseif ($resPages <= 5) {
				self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
			} else {
				if (isset($_GET['p']) && $_GET['p'] >= 4 && $_GET['p'] <= $resPages - 3) {
					if($i == $_GET['p'] - 1 || $i == $_GET['p'] + 1) {
						self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
					} elseif($i == 1) {
						self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a> ...';
					} elseif($i == $resPages) {
						self::$textPag .= '... <a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
					} else {
						self::$textPag .= '';
					}
				} elseif (isset($_GET['p']) && $_GET['p'] >= $resPages - 2) {
					if($i >= $resPages - 3) {
						self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
					} elseif($i == 1) {
						self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a> ...';
					} else {
						self::$textPag .= '';
					}
				} else {
					if ($i == $resPages) {
						self::$textPag .= ' ... <a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
					} elseif ($i >= 5 && $i != $resPages) {
						self::$textPag .= '';
					} else {
						self::$textPag .= '<a href="?'.$getCat.'p='.$i.'" style="margin: 0 2px">'.$i.'</a>';
					}
				}
			}
		}

		self::$textPag .= $after;
		return self::$textPag;
	}

	static public function Q($str = '') {
		if ($str == '') {
			if (isset($_GET['p'])) {
				$res2 = q("
						SELECT *
						FROM `".self::$table."`
						ORDER BY `id`
						LIMIT ".($_GET['p'] - 1) * self::$wantCount.", ".self::$wantCount."
						");
			} else {
				$res2 = q("
						SELECT *
						FROM `".self::$table."`
						ORDER BY `id`
						LIMIT ".self::$wantCount."
						");
			}
		} else {
			if (isset($_GET['p'])) {
				$res2 = q("
						SELECT
						FROM `".self::$table."`
						".$str."
						ORDER BY `id`
						LIMIT ".($_GET['p'] - 1) * self::$wantCount.", ".self::$wantCount."
						");
			} else {
				$res2 = q("
						SELECT *
						FROM `".self::$table."`
						".$str."
						ORDER BY `id`
						LIMIT ".self::$wantCount."
						");
			}
		}
		return $res2;
	}
}