<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_News extends Model
{
    /*
     * ALTER TABLE `larv2012`.`news` ADD COLUMN `visible` TINYINT NULL DEFAULT 1  AFTER `author` ;
     */
	public function get_news($limit = false, $onlyvisible = false){
		$query = DB::select_array(array('news.*', 'user.fname', 'user.lname'))
			->from('news')
			->join('user')
			->on('news.author', '=', 'user.user_id')
			->order_by('published', 'desc');

        if($onlyvisible)
            $query->where('visible', '=', '1');

		if($limit)
			$query->limit($limit);

		return $query->execute()
			->as_array();
	}
	public function get_details($id){
		list($result) = DB::select('*')
				->from('news')
				->where('id', '=', $id)
				->execute()
				->as_array();
		return $result;
	}

	public function update_by_id($id, $title, $text, $author, $visible)
	{
		DB::update('news')
			->set(array(
				'author'  => $author,
				'title'   => $title,
				'text'    => $text,
			    'visible' => $visible,
			))
			->where('id', '=', $id)
			->execute();
	}
	public function create($title, $text, $author, $timestamp, $visible)
	{
		list($id, $null) = DB::insert('news', array('title', 'text', 'author', 'published', 'visible'))
			->values(
				array(
					'title'		=> $title,
					'text'		=> $text,
					'author'	=> $author,
					'published'	=> $timestamp,
				    'visible'   => $visible,
				)
			)
			->execute();
		return $id;
	}
	public function delete($id)
	{
		DB::delete('news')
			->where('id', '=', $id)
			->execute();
	}

}