<?php
	include("include/Tree.class.php");
	
	class WorkType{
		var $tree;
		var $selectBox;
		var $menuStructure;
		function __construct(){
			$tree = new Tree();
			//$tree->num_nodes;
			$this->selectBox = $tree->selectRender();
			$this->menuStructure = $tree->editRender();
		}
	}
?>
