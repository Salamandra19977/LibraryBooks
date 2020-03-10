<?php
	require_once "pdo/database.php";
	class ShowData
	{
		public function getData(){
			$objDatabase = new Database();
			foreach ($objDatabase->get_all() as $key => $item) {
				echo "<li>id: $item[id] 
				название: $item[title] 
				описание: $item[description] 
				автор: $item[author] 
				дата публикации: $item[publication_date] 
				категория: $item[category]</li>"; 
			}
		}
		function __construct()
		{
			$this->getData();
		}
	}
	$objData = new ShowData();
