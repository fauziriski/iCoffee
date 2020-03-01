<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Use App\Post;
use App\Balance_withdrawal;

public function ajax()
{
	return $this->datatables
	->eloquent($this->query())
	->make(true);
}

public function query(){
	$users = Post::Balance_withdrawal::All()
	->select([
		'posts.id as id',
		'posts.title as title',
		'posts.created_at as created_at',
		'posts.updated_at as updated_at',
		'users.name as created_by'
	])
	->leftJoin('users', 'posts.user_id', '=', 'users.id');

	return $users;
}
