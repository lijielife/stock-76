<?php

include("config.php");

class db
{

	public function __construct()
			{
			global $server, $user, $pwd, $bdd;
			$this->ide = mysql_connect($server,$user,$pwd);
			mysql_select_db($bdd,$this->ide);
			}
	
	public function __get($var) 
			{
			return (!empty($this->$var)) ? $this->$var : false;
			}

	public function __set($var, $val) 
			{
			$this->$var = $val;
			}
			
	public function row ()
			{
			return mysql_fetch_object($this->resultat);
			}
				
	public function findall($table,$order)
			{
			mysql_query("SET NAMES UTF8");
			$this->requete = "SELECT * FROM $table  WHERE 1 ORDER BY $order ASC";
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->nbligne = mysql_num_rows($this->resultat);
			return $this->resultat;
			}
	
			
	public function findonly()
			{
			mysql_query("SET NAMES UTF8");
			$this->whatwhat = "";
			$numargs = func_num_args();
			$arg_list = func_get_args();
			$this->table = $arg_list[0];
			$this->order = $arg_list[1];
			  for ($i = 1; $i < ($numargs-1); $i++) {
			     $this->whatwhat .= $arg_list[$i] . ", ";
			  }
			$this->whatwhat .= $arg_list[($numargs-1)];
			$this->requete = "SELECT " . $this->whatwhat . " FROM " . $this->table . " WHERE 1 ORDER BY $this->order ASC";
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->nbligne = mysql_num_rows($this->resultat);
			return $this->resultat;
			}
			
			
	public function findone()
				{
				mysql_query("SET NAMES UTF8");
				$this->whatwhat = "";
				$numargs = func_num_args();
				$arg_list = func_get_args();
				$this->table = $arg_list[0];
				$this->id = $arg_list[1];
				$this->requete = "SELECT * FROM " . $this->table . " WHERE id_".$this->table."='". $this->id ."'";
				$this->resultat = mysql_query($this->requete,$this->ide);
				$this->nbligne = mysql_num_rows($this->resultat);
				return $this->resultat;
					}
				
	public function findquery($query)
			{
			$this->requete = "$query";
			mysql_query("SET NAMES UTF8");
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->nbligne = mysql_num_rows($this->resultat);
			$this->__set('numrows', $this->nbligne);
			return $this->resultat;
			}
	
	
	public function findupdate($query)
			{
			mysql_query("SET NAMES UTF8");
			$this->resultat = mysql_query($query,$this->ide);
			return $this->resultat;
			}
			
			
	public function save()
			{
			mysql_query("SET NAMES UTF8");
			$this->watwat = "";
			$numargs = func_num_args();
			$arg_list = func_get_args();
			$this->table = $arg_list[0];
			  for ($i = 1; $i < ($numargs-1); $i++) {
				    $this->watwat .= $arg_list[$i]  . ", ";
				 }
			$this->watwat .= $arg_list[($numargs-1)];
			$this->requete = "insert into $this->table values ($this->watwat)";
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->__set('flashmess',"$arg_list[2] bien enregistr&eacute; dans $this->table");
			$this->lastid = mysql_insert_id();
			$this->__set('quelidee', $this->lastid);
			}
			
	public function newsave($table, $lesvaleurs)
			{
			mysql_query("SET NAMES UTF8");
			$this->watwat = "";
			
			reset($lesvaleurs);
			
			$col = implode(",",array_keys($lesvaleurs));
			$val = implode(",",array_values($lesvaleurs));

			$this->requete = "insert into $table ($col) VALUES($val)";
			echo $this->requete;
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->lastid = mysql_insert_id();
			$this->__set('quelidee', $this->lastid);
			}	
			
			
		public function delete($table, $id)
				{
				$this->requete = "DELETE FROM $table WHERE id_".$table."='". $id ."'";
				$this->resultat = mysql_query($this->requete,$this->ide);
				$this->__set('flashmess',"$this->id bien effac&eacute; dans table");
				}
					
	public function update()
			{
			mysql_query("SET NAMES UTF8");
			$this->watwat = "";
			$numargs = func_num_args();
			$arg_list = func_get_args();
			$this->table = $arg_list[0];
			$this->id = $arg_list[1];
				for ($i = 2; $i < ($numargs-1); $i++) {
				    $this->watwat .= $arg_list[$i]  . ", ";
				 }
			$this->watwat .= $arg_list[($numargs-1)];
			$this->requete = "UPDATE $this->table SET $this->watwat WHERE id_".$this->table."=$this->id ";
			$this->resultat = mysql_query($this->requete,$this->ide);
			$this->__set('flashmess',"$arg_list[1] bien modifi&eacute; dans $this->table");
			}
			
	
	public function __destruct()
			{
	
			}
}

?>