<?php defined('SYSPATH') or die('No direct script access.');

class Controller_skills extends Controller_SuperController {

    public function action_welcome($arg1 = null, $arg2 = null){
        $this->css[] = '/css/form.css';
        $this->content = View::factory('skills');
        $this->content->skills = DB::select('*')
               ->from('skill')
               ->order_by('name', 'ASC')
               ->execute()->as_array();
        $userskills = DB::select('*')
               ->from('userskill')
               ->where('userid', '=', $this->session->get('user')->getId())
               ->execute()->as_array();
        $rearranged_userskills = array();
        foreach($userskills as $us)
           $rearranged_userskills[$us['skillid']] = $us['time'];
        $this->content->userskills = $rearranged_userskills;
    }
    public function action_update(){
        //$delete = DB::delete('userskill')->where('userid', '=', $this->session->get('user')->getId());
        $all_skills = array();
        foreach(DB::select_array(array('name', 'sid'))->from('skill')->execute()->as_array() as $s)
            $all_skills[$s['sid']] = $s['name'];

        $new_skills = $_POST['skill'];
        $old_skills_remade = array();

        //Add Skills - Start
        $old_skills = DB::select('*')
                ->from('userskill')
                ->where('userid', '=', $this->session->get('user')->getId())
                ->execute()
                ->as_array();

        foreach($old_skills as $o){
            if(array_search($o['skillid'], $_POST['skill']) !== FALSE)
                unset($_POST['skill'][array_search($o['skillid'], $_POST['skill'])]);
            $old_skills_remade[] = $o['skillid'];
        }
        $insert = DB::insert('userskill', array('skillid', 'userid', 'time'));
        foreach($_POST['skill'] as $s){
            $insert->values(array($s, $this->session->get('user')->getId(), time()));
        }
        if(count($_POST['skill']))
            $insert->execute();
        //Add Skills - End
        //Delete Skills - Start
        $delete = DB::delete('userskill')->where('userid', '=', $this->session->get('user')->getId());
        $delete_skills = array();
        foreach($new_skills as $n){
            if(array_search($n, $old_skills) === FALSE)
                unset($old_skills_remade[array_search($n, $old_skills_remade)]);
        }
        if(count($old_skills_remade))
            $delete->where('skillid', 'in', DB::expr('('.implode($old_skills_remade,',').')'))->execute();
        //Delete Skills - End
        $this->request->redirect('/skills');
    }
} // End Welcome
