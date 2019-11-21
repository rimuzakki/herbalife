<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peserta_model extends CI_Model{
  function get_status_entry_count(){
    $sql = 'SELECT COUNT(*) AS total, COUNT(CASE WHEN peserta.`hadir`=1 THEN 1 END) AS sudah, COUNT(CASE WHEN peserta.`hadir`=0 THEN 1 END) AS belum FROM `peserta`';
    return $this->db->query($sql);
  }

  function get_status_entry_count_by_kelompok(){
    $sql = 'SELECT `kelompok`.`kelompok`,  COUNT(*) AS total, COUNT(CASE WHEN peserta.`hadir`=1 THEN 1 END) AS sudah, COUNT(CASE WHEN peserta.`hadir`=0 THEN 1 END) AS belum FROM `peserta` INNER JOIN `kelompok` ON (`peserta`.`level_herbalife` = `kelompok`.`kelompok`) GROUP BY `kelompok`.`kelompok`';
    return $this->db->query($sql);
  }
}