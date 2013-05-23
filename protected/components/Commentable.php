<?php
/**
 * Commentable interface file.
 * 
 * @author Jin Hu <bixuehujin@gmail.com>
 */

interface Commentable {
	
	public function getOwnerId();
	
	public function getOwnerType();
	
	public function updateCommentCounter($count);
	
	public function getCommentCount();
	
}
