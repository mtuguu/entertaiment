<?php
	require('include/config.php');
	
	/************************************
	 * ClassName: TreeNode
	 * Мод бүтэцтэй цэсний мөчир буюу нэг холбоос. 
	 * Author: GansukhB
	 * Created: 2011/2/11
	 * ********************************* */
	class TreeNode{
		var $nodeId;	// мөчрийн ID
		var $parentId;	// эцэг мөчрийн ID
		var $isParent;  // уг мөчир хүүтэй эсэхийг заана
		var $mn_name;	// Цэсний нэр
		var $en_name;	// Цэсний тайлбар
		
		var $childNodes;// Хүүхдүүдийг агуулах хүснэгт
		
		/*
		 * Байгуулагч функц
		 * */
		public function TreeNode($nid, $pid, $isp, $mn, $en){
			$this->nodeId = $nid;
			$this->parentId = $pid;
			$this->isParent = $isp;
			$this->mn_name = $mn;
			$this->en_name = $en;
		}
	}
	class Tree{
		var $roots;		// Цэсний үндсэн элемэнтүүд
		var $allNodes;	// Цэсэнд агуулагдах бүх холбоос
		var $numNodes;	// Цэсэнд агуулагдах холбоосын тоо
				
		var $rv;		// Функцсийн буцаах утганд хэрэглэхээр үүсгэсэн хувьсагч
		var $erv; 		// Функцсийн буцаах утганд хэрэглэхээр үүсгэсэн хувьсагч
		
		var $conn;		// Өгөгдлийн сантай холбох холболт
		
		/*
		 * Модыг байгуулагч функц.
		 * 
		 * */
		function __construct(){
			$this->allNodes = array();	// Мөчрүүдийг агуулах хүснэгт
			$this->syncDb();			// Өгөгдлийн сантай холбож, мөчрүүдийг цуглуулна
			$this->makeTree();			// Цуглуулсан мөчрүүдийг хэлхэж мод үүсгэнэ
		}
		function syncDb(){
			/*
			 * MySQLi холболт үүсгэнэ
			 * */
			$this->conn = new mysqli(
				DB_SERVER,
				DB_USERNAME,
				DB_PASSPASS,
				DB_DATABASE) or die("Connection error: ".mysqli_connect_error());
			
			/*
			 * Цэстэй холбоотой бүх өгөгдлийг авна.
			 * */
			$menu_items = $this->conn->query('SELECT * FROM work_type');

			if($menu_items){
				while(list($id, $parent_id, $is_parent, $mn, $en)
					 	= $menu_items->fetch_array()){
					/*
					 * ӨС-гийн бичлэг бүрийн хувьд түр зуурын мөчир үүсгээд 
					 * Мөчрүүдийг агуулах хүснэгт рүү хийнэ
					 * */
					$tempNode = new TreeNode(
						$id, $parent_id, $is_parent, $mn, $en);
					$tempNode->childNodes = array();
					
					array_push($this->allNodes, $tempNode);
				}	
			}
			$this->numNodes = count($this->allNodes);
		}
		/*
		 * FunctionName: getByNode
		 * Мөчрийн ID өгөгдөхөд allNodes хүснэгтэд агуулагдах индэксийг
		 * буцаана
		 * */
		function getByNode($ind){ 
			for($i = 0; $i < $this->numNodes; $i++){
				if($this->allNodes[$i]->nodeId == $ind)
					return $i;
			}
		}
		/*
		 * FunctionName: makeTree
		 * Модыг үүсгэх функц
		 * */
		function makeTree(){
			$this->roots = array();
			
			/*
			 * 
			 * Мөчир болгоны хувьд эцэггүй мөчрүүдийг roots хүснэгтэд
			 * эцэгтэй мөчрүүдийг тухайн мөчрийн эцэг мөчрийн хүүхдүүдийг
			 * агуулах childNodes хүсэгт рүү оруулна
			 * */
			foreach($this->allNodes as $node){
				if($node->parentId > 0){
					array_push(
						$this->allNodes[$this->getByNode($node->parentId)]->childNodes, 
						$node);
				} else{ 
					array_push($this->roots, $node);
				}
			}
		}
		
		/*
		 * FunctionName: render
		 * Цэсийг зурах функц
		 * 
		 * */
		function render(){			
			$this->rv = '<div id="myslidemenu" class="jqueryslidemenu"><ul>';
			
			/*
			 * Үндсэн мөчрүүдийн хувьд тэдний хойч үеийн судалгааг хийж,
			 * мэдээллийг нь $rv хувьсагчид онооно
			 * */
			foreach($this->roots as $node){
				/*
				 * DFS(Depth First Search) буюу гүний нэвтэрлтийг хийнэ
				 * */
				$this->selectDisplay($node->nodeId);
			}
			$this->rv .= '</ul><br style="clear: left" /></div>'; 
			/*
			 * Оноосон утгуудын нийлбэр цогц, HTML кодыг буцаана
			 * */
			return $this->rv; 
		}
		public function selectDisplay($id){
			$ind = $this->getByNode($id);
			
			$sr = count($this->allNodes[$ind]->childNodes);
			
			if(0 == $sr){
				$this->rv .= '<li><a href="#">'.$this->allNodes[$ind]->nodeId.' '.$this->allNodes[$ind]->menuLabel.'</a></li>';
			}
			else{
				$this->rv .= 	'<li><a href="#">'.$this->allNodes[$ind]->nodeId.' '.$this->allNodes[$ind]->menuLabel.'</a><ul>';

				foreach($this->allNodes[$ind]->childNodes as $node){
					$this->selectDisplay($node->nodeId);
				}
				$this->rv .= '</ul></li>'; 
			}
		}
		f
		
		
		unction render(){			
			$this->rv = '<div id="myslidemenu" class="jqueryslidemenu"><ul>';
			
			/*
			 * Үндсэн мөчрүүдийн хувьд тэдний хойч үеийн судалгааг хийж,
			 * мэдээллийг нь $rv хувьсагчид онооно
			 * */
			foreach($this->roots as $node){
				/*
				 * DFS(Depth First Search) буюу гүний нэвтэрлтийг хийнэ
				 * */
				$this->display($node->nodeId);
			}
			$this->rv .= '</ul><br style="clear: left" /></div>'; 
			/*
			 * Оноосон утгуудын нийлбэр цогц, HTML кодыг буцаана
			 * */
			return $this->rv; 
		}
		/*
		 * FunctionName: display
		 * Гүний нэвтрэлт хийж, хүүхдүүдийн талаар мэдээллийг
		 * HTML код болгон залгана
		 * */
		public function display($id){
			$ind = $this->getByNode($id);
			
			$sr = count($this->allNodes[$ind]->childNodes);
			
			if(0 == $sr){
				$this->rv .= '<li><a href="#">'.$this->allNodes[$ind]->nodeId.' '.$this->allNodes[$ind]->menuLabel.'</a></li>';
			}
			else{
				$this->rv .= 	'<li><a href="#">'.$this->allNodes[$ind]->nodeId.' '.$this->allNodes[$ind]->menuLabel.'</a><ul>';

				foreach($this->allNodes[$ind]->childNodes as $node){
					$this->display($node->nodeId);
				}
				$this->rv .= '</ul></li>'; 
			}
		}
		/*
		 * FunctionName editRender()
		 * меню засварлагчийг зурах функц
		 * өмнөх render() функцтэй адил зарчмаар ажиллана
		*/
		public function editRender(){
			$this->erv = '<form id="pane" method="post"><ul>';
			
			$sr = count($this->roots);	// size of roots;
			
			for($i = 0; $i < $sr; $i++){
				$this->editDisplay($this->roots[$i]->nodeId);
			}
			
			$this->erv .= '</ul></form>';
			return $this->erv;
		}
		/*
		 * FunctionName editDisplay()
		 * меню засварлагчийг зурах функц
		 * өмнөх display() функцтэй адил зарчмаар ажиллана
		*/
		public function editDisplay($id){
			$ind = $this->getByNode($id);
			
			$sr = count($this->allNodes[$ind]->childNodes);
			if(0 == $sr){
				$this->erv .= "<li><a href='#'>".$this->allNodes[$ind]->nodeId."</a> "
				.$this->allNodes[$ind]->menuLabel.$this->editBox($this->allNodes[$ind]->nodeId, 
				$this->allNodes[$ind]->parentId)."</li>";
			}
			else{
				$this->erv .= "<li><a href='#'>".$this->allNodes[$ind]->nodeId."</a> "
				.$this->allNodes[$ind]->menuLabel.$this->editBox($this->allNodes[$ind]->nodeId, 
				$this->allNodes[$ind]->parentId)."<ul>";
				for($i = 0; $i < $sr; $i++){
					$this->editDisplay($this->allNodes[$ind]->childNodes[$i]->nodeId, $this->allNodes[$ind]->childNodes[$i]->parentId);
				}
				$this->erv .= "</ul></li>\n"; 
			}
		}
		/*
		 * FunctionName: editBox();
		 * selectBox сонголтыг зурна
		 * 
		 * */
		public function editBox($nid, $parent){
			$val = "<select id='parentbox$nid' onmouseup='Process($nid);'>\n"; 
			//if($parent == 0){
			//	$val .= '<option value="'.'0'.'" selected>'.'Үндэс'.'</option>';
			//}else 
			$val .= "<option value='"."0"."'>"."Үндэс"."</option>\n";
			for($i = 0; $i < $this->numNodes; $i++){
				$selected = '';
				
				$val .= "<option value='".$this->allNodes[$i]->nodeId."' ".$selected.">".$this->allNodes[$i]->menuLabel."</option>\n";
					
			}
			$val .= "</select>\n";
			return $val;
		}
		/*
		 * FunctionName: updateParent
		 * Эцэг, хүүгийн холбоог өөрчлөх(цэсний байрлалыг зөөх)
		 * үед ажиллана
		 * */
		public function updateParent($node, $parent){
			$indexNode = $this->getByNode($node);
			$indexParent = $this->getByNode($parent);
			
			/*
			 * check() функцийг ашиглан үр удмыхаа хүүхэд болох хүсэлт
			 * ирсэн эсэхийг шалгаж байж биелүүлнэ
			 * */
			if($node && $this->check($node, $parent) == true){
				$qry = 'UPDATE '.T_MENU.' SET parent_id = '.$parent.' WHERE id = '.$node;//.' AND parent_id != '.$parent;
				$this->conn->query($qry);
			}
		}
		
		/*
		 * Үр удмыхаа хүүхэд хүсэлт ирсэн эсэхийг шалгана.
		 * */
		function check($node, $parent){	
			$this->rv = true;		
			/*
			 * Гүний нэвтрэлт
			 * */
			$this->dfs($node, $parent);
			return $this->rv;
		}
		
		public function dfs($id, $parent){
			$ind = $this->getByNode($id);
			
			/*
			 * Хүүхдүүд дундаас ирсэн хүсэлт дахь эцгийн ID олдвол
			 * false утгыг check() функц буцаана
			 * */
			if($id == $parent)
				$this->rv = false;
			foreach($this->allNodes[$ind]->childNodes as $node){
				$this->dfs($node->nodeId, $parent);
			}
		}
	}
?>
