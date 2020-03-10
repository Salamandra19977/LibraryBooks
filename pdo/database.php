<?php
    require_once('Connect.php');    
    class Database extends Connect
    {
        public $table_name = 'books';

        public function insert($data)
        {
            $data['create_at'] = Date('Y-m-d H:i:s');
            $fields = $this->set_fields($data);
            $sql = "INSERT INTO `{$this->table_name}` SET ".$fields;
            $stmt = $this->pdo->prepare( $sql );

            return $stmt->execute($data);
        }

        public function update($data, $id)
        {
            $fields = $this->set_fields($data,$id);
            $sql = "UPDATE `{$this->table_name}` SET ".$fields.' WHERE id='.$id;
            $stmt = $this->pdo->prepare( $sql );

            return $stmt->execute($data);
        }

        public function set_fields( $items, $delimiter = "," ){
            $str = array();
            if(empty($items)) return "";
            foreach ($items as $key=>$item){
                $str[] = "`".$key."`=:".$key;
            }
            return implode($delimiter, $str );
        }

        public function get_count( $where = array() )
        {
            $sql = "SELECT count(*) FROM {$this->table_name}";
            if( count( $where) > 0 ){
                $fields = $this->set_fields($where, " AND ");
                $sql .= " WHERE ".$fields;
            }
            $smtp = $this->pdo->prepare($sql);
            $smtp->execute($where);
            $result = $smtp->fetch( PDO::FETCH_NUM );

            return (int)$result[0];
        }

        public function get_all($order = "id asc")
        {
            $sql = "SELECT * FROM `{$this->table_name}` ORDER BY $order";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        }

        public function get_one($where = [], $order = "id asc")
        {
            $sql = "SELECT * FROM `{$this->table_name}`";
            if( count( $where) > 0 ){
                $fields = $this->set_fields($where, " AND ");
                $sql .= " WHERE ".$fields;
            }
            $sql .= " ORDER BY $order";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($where);
            $result = $stmt->fetch();

            return $result;
        }
    }