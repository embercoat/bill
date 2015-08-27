<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_Dynamic extends Model
{
	public function delete_by_name($name){
		$name = str_replace('_', '.', $name);
		DB::delete('dynamic')
			->where('name', '=', $name)
			->execute();
	}
	public function delete_by_id($id){
		DB::delete('dynamic')
			->where('id', '=', $id)
			->execute();
	}
	public function get_content_by_id($id)
	{
		$content = DB::select('*')
							->from('dynamic')
							->where('id', '=', $id)
							->execute()
							->as_array();
		if(count($content) == 0)
		{
			return array('content' => '');
		}
		else
		{
			return array_pop($content);
		}							
		
	}
	public function get_content_by_name($page)
	{
		$content = DB::select('*')
							->from('dynamic')
							->where('name', '=', $page)
							->order_by('edited', 'DESC')
							->limit(1)
							->execute()
							->as_array();
		if(count($content) == 0)
		{
			return array('content' => '');
		}
		else
		{
			return array_pop($content);
		}							
														
		return $content;
	}
	public function update_by_id($id, $content)
	{		
		list($result) = DB::select('name')
						->from('dynamic')
						->where('id', '=', $id)
						->execute()
						->as_array();
						
		$this->update_by_name($result['name'], $content);
	}
	public function update_by_name($name, $content)
	{
		$query = DB::insert('dynamic', array('name', 'content', 'editor', 'edited'))
			->values( array(
				'name'		=> $name,
				'content'	=> trim($content), 
				'editor'	=> Auth::instance()->get_user()->id,
				'edited'	=> time()
			))
			->execute();
	}
	public function exists($name){
		list($result) = DB::select(DB::expr('count(1) as count'))
						->from('dynamic')
						->where('name', '=', $name)
						->execute()
						->as_array();
		return (($result['count'] == 0) ? false : true);
	}
}