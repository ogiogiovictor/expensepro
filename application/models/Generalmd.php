<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Generalmd extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db4 = $this->load->database('ciprocuredb', TRUE);
        $this->db8 = $this->load->database('assetmanagement', TRUE); 
        
    }

    public function saveToDB($table, $array) {
        $key = array_keys($array);
        $values = array_values($array);
        $q = "INSERT INTO `$table` (" . implode(', ', $key) . ") VALUES ('" . implode("', '", $values) . "')";

        $insertDB = $this->db->query($q);
        if ($this->db->affected_rows($insertDB) > 0) {

            $insertId = $this->db->insert_id();
            return $insertId;
        } else {
            return FALSE;
        }
    }

    /*     * *** This controller returns all users ***** */

    public function getsinglecolumnfromotherdb($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db4->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }

    ///////////////////////////////USED TO RETURN A SINGLE RESULT FROM THE DATABASE //////////////////////////////////
    public function getuserAssetLocation($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        $q = "SELECT $column FROM $table WHERE $wherecluase = '$email'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }

    ///////////////////////////////END OF SINGLE RESULT FROM THE DATABASE //////////////////////////////////  

    /*  public function getallassetbasedoncatandlocal($catgory, $getLocale, $getDepartment) {
      $q = "SELECT id, aCategory, aCategoryName, subCategory, COUNT(aCategory) AS categoryCount FROM asset_register WHERE assignLocation = '$getLocale' AND aDepartment='$getDepartment' AND whichplace IN ('old', 'new', 'procurement') AND disposedStatus = 'active' GROUP BY aCategory";

      $run_q = $this->db->query($q);

      if ($run_q->num_rows() > 0) {
      return $run_q->result();
      } else {
      return "";
      }
      }

     */
    //Return a single columns from a table // FOR EXPENSE PRO
    public function getsinglecolumn($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }

    //This returns result from a table
    public function getdresult($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else if ($column == "*") {
            $q = "SELECT * FROM $table";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    //This returns result from a table
    public function getdresultin($column, $table, $wherecluase, $email) {
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase IN('" . $email . "')";
        } else if ($column == "*") {
            $q = "SELECT * FROM $table";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    ///////////////////////////////END OF SINGLE RESULT FROM THE DATABASE //////////////////////////////////  
    /////////////////////////////USED TO INSERT DATA INTO A TABLE //////////////////////////////////////////////

    public function create($options) {
        // Check if $option is truly an array and contains the keys needed
        if (is_array($options) && array_key_exists('data', $options) && array_key_exists('table', $options)) {
            $response = $this->db->insert($options['table'], $options['data']);
            $insertId = $this->db->insert_id();
            return $insertId;
        } else {
            return false;
        }
    }

    public function count_with_where($table_name, $column_name, $type) {
        $this->db->select($column_name);
        $this->db->where($column_name, $type);
        $q = $this->db->get($table_name);
        $count = $q->result();
        return count($count);
    }

    public function count_with_where_nocolumn_name($table_name, $column_name, $type) {
        //$this->db->select($column_name);
        //$this->db->order_by("id", "DESC");
        $this->db->where($column_name, $type);
        $q = $this->db->get($table_name);
        $count = $q->result();
        return count($count);
    }

    public function fetch($tableName, $limit, $offset, $column_name, $type) {
        $this->db->order_by("datePaid", "DESC");
        $this->db->limit($limit, $offset);
        $this->db->where($column_name, $type);
        $query = $this->db->get($tableName);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function search_result($tablename, $columnvalue) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->order_by("fmrequestID", "DESC");
        $this->db->like("fmrequestID", $columnvalue);
        $this->db->or_like("Amount", $columnvalue);
        $this->db->or_like("paidTo", $columnvalue);
        $this->db->or_like("requesterEmail", $columnvalue);
        $this->db->or_like("partpayAmount", $columnvalue);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function search_result_byicu($tablename, $columnvalue) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->like("id", $columnvalue);
        $this->db->or_like("dAmount", $columnvalue);
        $this->db->or_like("partPay", $columnvalue);
        $this->db->or_like("dateCreated", $columnvalue);
        $this->db->or_like("ndescriptOfitem", $columnvalue);
        $this->db->or_like("dICUwhoapproved", $columnvalue);
        $this->db->or_like("dICUwhorejectedrequest", $columnvalue);
        $this->db->or_like("sageRef", $columnvalue);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function columns_specific_result($table_name, $limit, $offset, $column_name, $type, $type2 = "") {
        $this->db->limit($limit, $offset);
        $this->db->select($column_name);
        $this->db->order_by("id", "DESC");
        //$this->db->where_not_in($type, "");
        $this->db->where('dICUwhoapproved !=', $type)->or_where('dICUwhorejectedrequest !=', $type2);
        //$this->db->where('dICUwhorejectedrequest !=', $type2);
        $query = $this->db->get($table_name);
        //var_dump($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    //Return a single columns from a table // FOR EXPENSE PRO
    public function getsharedbefore($table, $columfield, $columvalue, $columfield2, $columvalue2, $columfield3, $columvalue3) {
        $q = "SELECT * FROM $table WHERE $columfield = '" . $columvalue . "' AND $columfield2 = '" . $columvalue2 . "' AND $columfield3 = '" . $columvalue3 . "'";
        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //This returns result from a table
    public function getdresultfromfile($table, $wherecluase, $email, $notemptycolumn) {
        $q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "' AND $notemptycolumn != ''";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function update($column, $columnvalue, $options) {

        $this->db->where($column, $columnvalue);
        $resp = $this->db->update($options['table'], $options['data']);

        return $resp;
    }

    public function intotoReimbursement($cashierEmail, $langID) {
        $q = "INSERT into reimbursementTable (cashierEmail, langIDs, dateSent) VALUES(?, ?, NOW())";
        $insertDB = $this->db->query($q, [$cashierEmail, $langID]);

        if ($this->db->affected_rows($insertDB) > 0) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {

            return FALSE;
        }
    }

    public function updatemyreimbursement($amount, $ids) {
        $update = "UPDATE reimbursementTable SET `amount`='$amount' WHERE `ids`='$ids'";
        $this->db->query($update);
        return TRUE;
    }

    public function getsinglecolumnfromotherdbfortable($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db4->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }

    //This returns result from a table
    public function getaccountcodefromdb($table, $wherecluase, $email) {
        $q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    ///////////////////////////USING THIS WITH THE AND SIGN /////////////////////////////////////////////////////
    public function getsinglecolumnwithand($column, $table, $wherecluase, $valueone, $wherecluasetwo, $valuetwo) {

        $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $valueone . "' AND  $wherecluasetwo = '" . $valuetwo . "' ";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            foreach ($run_q->result() as $get) {
                return $get->$column;
            }
        } else {
            return FALSE;
        }
    }

    //update purch_order_details SET po_req=1,audit='Payment Requested' WHERE po_detail_item IN ($nameds)");
    /* public function procureupdate($array, $audit){  
      $update = "UPDATE purch_order_details SET `po_req`='1', `audit`= '$audit' WHERE `po_detail_item` IN($array)";
      $this->db4->query($update);
      return TRUE;
      }
     */

     public function procureupdate($updateApprove, $createdby, $array){
        $q = "UPDATE purch_order_details SET `po_req`='2', `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END WHERE `po_detail_item` IN($array)";
	//$q1 = "UPDATE `purch_orders` SET status='2' WHERE reference = (SELECT order_no FROM purch_order_details WHERE po_detail_item IN ($array) GROUP BY order_no)";
        $this->db4->query($q);
	//$this->db4->query($q1);
        return TRUE;
    }
    
    
    public function updateprocurementportal($updateApprove, $createdby, $status, $array) {
        $q = "UPDATE purch_order_details SET `po_req`='$status', `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END WHERE `po_detail_item` IN($array)";
        $q = "UPDATE `purch_orders` SET status='$status',  `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END"
                . " WHERE reference = (SELECT order_no FROM purch_order_details WHERE po_detail_item IN ($array) GROUP BY order_no)";
        $this->db4->query($q);
        //$this->db4->query($q1);
        return TRUE;
    }

    public function rejectprocurementportal($updateApprove, $createdby, $status, $array) {
        $q = "UPDATE purch_order_details SET `po_req`='$status', `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END WHERE `po_detail_item` IN($array)";
        $q = "UPDATE `purch_orders` SET status='$status',  `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END"
                . " WHERE reference = (SELECT order_no FROM purch_order_details WHERE po_detail_item IN ($array) GROUP BY order_no)";

        $q = "UPDATE `quotereport` set status='4'  WHERE batchid = (SELECT order_no FROM purch_order_details WHERE po_detail_item IN ($array) GROUP BY order_no)";
        $this->db4->query($q);
        //$this->db4->query($q1);
        return TRUE;
    }

    public function procureupdaterejected($updateApprove, $createdby, $array) {
        $q = "UPDATE purch_order_details SET `po_req`='3', `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END WHERE `po_detail_item` IN($array)";


        //$q = "UPDATE purch_orders SET `status`='2', `audit`= CASE WHEN audit = '' THEN '$updateApprove' ELSE CONCAT(`audit`, '$createdby') END WHERE `po_detail_item` IN($array)";
        $this->db4->query($q);
        return TRUE;
    }

    //This returns result from a table
    public function getdresultfromprocure($column, $table, $wherecluase, $email) {
        //$q = "SELECT $column FROM cash_usersetup WHERE email = ?";
        if ($wherecluase && $email) {
            $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $email . "'";
        } else if ($column == "*") {
            $q = "SELECT * FROM $table";
        } else {
            $q = "SELECT $column FROM $table";
        }

        $run_q = $this->db4->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function columns_specific_resultother($table_name, $limit, $offset, $column_name, $sessionID) {
        $this->db->limit($limit, $offset);
        $this->db->select($column_name);
        $this->db->order_by("id", "DESC");
        //$this->db->where_not_in($type, "");
        //$this->db->where('dICUwhoapproved !=', $type)->or_where('dICUwhorejectedrequest !=', $type2);
        $this->db->where('sessionID =', $sessionID);
        $query = $this->db->get($table_name);
        //var_dump($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function mysessionsearch($tablename, $columnvalue, $column_name, $type) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($column_name, $type);
        $this->db->group_start();
        $this->db->like("id", $columnvalue);
        $this->db->or_like("dAmount", $columnvalue);
        $this->db->or_like("partPay", $columnvalue);
        $this->db->or_like("dateCreated", $columnvalue);
        $this->db->or_like("ndescriptOfitem", $columnvalue);
        $this->db->or_like("nPayment", $columnvalue);
        $this->db->or_like("sageRef", $columnvalue);
        $this->db->group_end();
        $query = $this->db->get();
        //print_r($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function countbyaccountgroup($table_name) {
        //$this->db->select($column_name);
        //$this->db->order_by("id", "DESC");
        //$this->db->where('dAccountgroup =', 3);
        $this->db->where('nPayment =', "2");
        $this->db->where('approvals =', "3");
        $q = $this->db->get($table_name);
        $count = $q->result();
        return count($count);
    }

    public function getaccountresultbygroup($table_name, $limit, $offset, $column_name, $dgroup) {

        //$q = "SELECT * FROM cash_newrequestdb WHERE dAccountgroup = ? AND nPayment = '2' 
        //AND dICUwhoapproved != '' AND approvals = '3' AND approvals !='4' AND dCashierwhopaid = '' 
        //ORDER BY id desc LIMIT 5000";

        $this->db->limit($limit, $offset);
        $this->db->select($column_name);
        $this->db->order_by("id", "DESC");

        $this->db->where('dAccountgroup =', "$dgroup");
        $this->db->where('nPayment =', '2');
        $this->db->where('dICUwhoapproved !=', "");
        $this->db->where('approvals =', '3');


        $this->db->where('approvals !=', '4');
        $this->db->where('dCashierwhopaid =', "");


        //$array = array('dAccountgroup' => 1, 'approvals' => 3, 'nPayment' => 2);
        //$where = "dAccountgroup='$dgroup' AND approvals='3' AND nPayment='2'";
        //$this->db->where($where);
        $query = $this->db->get($table_name);

        //var_dump($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
            //return "";
        }
    }

    public function search_result_only_account($tablename, $search, $searchcriteria) {
        $this->db->select('id, ndescriptOfitem, dateICUapprove, md5_id, from_app_id, dLocation,dAccountgroup, hod, dateRegistered, nPayment, CurrencyType, dAmount, partPay, dateCreated, benName, sageRef, fullname, sessionID, approvals');
        $this->db->from($tablename);
        $this->db->order_by("id", "DESC");
        //$this->db->where($searchcriteria, $search);
        $this->db->where('nPayment =', '2');
        $this->db->where('approvals =', '3');
        $this->db->where('dICUwhoapproved !=', "");
        $this->db->like("$searchcriteria", $search);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function paymentCode($payCode, $id) {
        $update = "UPDATE cash_newrequestdb SET `userCode`='$payCode' WHERE `id`='$id'";
        $this->db->query($update);
        return TRUE;
    }

    public function getdMonthyear($dMonth, $dYear, $Unit) {
        //$q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "'";
        $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $dMonth AND YEAR(dateCreated) = $dYear AND dUnit = $Unit AND approvals ='3'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
    
      public function getdMonthyearbyRange($dmonth, $dyear, $Unit, $oneFirst, $oneSecond) {
        //$q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "'";
        $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $dmonth AND YEAR(dateCreated) = $dyear AND dUnit = $Unit AND Amount BETWEEN $oneFirst AND $oneSecond AND approvals ='3'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getbyRange($first, $second) {
        //$q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "'";
        $q = "SELECT * FROM cash_newrequestdb WHERE dAmount BETWEEN $first AND $second AND approvals ='3'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getbyRangepaid($first, $second) {
        //$q = "SELECT * FROM $table WHERE $wherecluase = '" . $email . "'";
        $q = "SELECT * FROM cash_newrequestdb WHERE dAmount BETWEEN $first AND $second AND approvals ='8' AND nPayment='2'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    ///////////////////////////USING THIS WITH THE AND SIGN /////////////////////////////////////////////////////
    public function withthreevaluesresult($column, $table, $wherecluase, $valueone, $wherecluasetwo, $valuetwo, $wherecluasethree, $valuethree) {

        $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $valueone . "' AND  $wherecluasetwo = '" . $valuetwo . "' AND  $wherecluasethree = '" . $valuethree . "' ";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function updateTableCol($tableName, $colName, $colVal, $whereCol, $whereColVal) {
        $q = "UPDATE $tableName SET $colName = ? WHERE $whereCol = ?";

        $this->db->query($q, [$colVal, $whereColVal]);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getallforadmin() {

        $q = "SELECT * FROM `travelstart_expense` WHERE `processFlight` = 'yes' AND  icuwhoapprove = '' ORDER BY tid DESC LIMIT 50";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function updatepassword($dolumn, $dCount, $dEmail) {
        $update = "UPDATE cash_usersetup SET `$dolumn`='$dCount' WHERE `email`='$dEmail'";
        $this->db->query($update);
        return TRUE;
    }

    public function getmonthyearoption($dMonth = "", $dYear = "", $Unit = "") {

        if ($dYear && $dMonth && $Unit) {
            $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $dMonth AND YEAR(dateCreated) = $dYear AND dUnit = $Unit AND approvals ='8' AND nPayment = '2'";
        } else if ($dYear && $dMonth) {
            $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $dMonth AND YEAR(dateCreated) = $dYear AND approvals ='8' AND nPayment = '2'";
        } else if ($dYear && $Unit) {
            $q = "SELECT * FROM cash_newrequestdb WHERE YEAR(dateCreated) = $dYear AND dUnit = $Unit AND approvals ='8' AND nPayment = '2'";
        } else if ($dYear) {
            $q = "SELECT * FROM cash_newrequestdb WHERE YEAR(dateCreated) = $dYear AND approvals ='8' AND nPayment = '2'";
        } else if ($dMonth) {
            $q = "SELECT * FROM cash_newrequestdb WHERE MONTH(dateCreated) = $dMonth AND approvals ='8' AND nPayment = '2'";
        } else if ($Unit) {
            $q = "SELECT * FROM cash_newrequestdb WHERE dUnit = $Unit AND approvals ='8' AND nPayment = '2'";
        }

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function getsearchtype($searchcriteria, $search) {

        $q = "SELECT * FROM `cash_newrequestdb` WHERE `$searchcriteria` LIKE '%$search%'";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    ///////////////////////////USING THIS WITH THE AND SIGN /////////////////////////////////////////////////////
    public function getresultwithand($column, $table, $wherecluase, $valueone, $wherecluasetwo, $valuetwo) {

        $q = "SELECT $column FROM $table WHERE $wherecluase = '" . $valueone . "' AND  $wherecluasetwo = '" . $valuetwo . "' ";

        $run_q = $this->db->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }

    public function updatedupdatetrail($updateApprove, $createdby, $acceptrequestID) {
        $q = "UPDATE travel_hotel_bookings SET  `auditTrail`= CASE WHEN auditTrail = '' THEN '$updateApprove' ELSE CONCAT(`auditTrail`, '$createdby') END WHERE hotel_id = '$acceptrequestID'";
        $this->db->query($q);
        return $acceptrequestID;
    }
    
    
    
     public function getajaxload($start, $limit) {
        $q = "SELECT * FROM maintenance_workshop ORDER BY id DESC LIMIT $start, $limit";
       
        $run_q = $this->db8->query($q);

        if ($run_q->num_rows() > 0) {
            return $run_q->result();
        } else {
            return FALSE;
        }
    }
    
     
      //Get the Category Type
    public function totalenuguphresult(){
       $q = "SELECT count(id) as dCount FROM cash_newrequestdb WHERE dLocation = '2' || dLocation = '8' || dLocation = '3' || dLocation = '6'";
        
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
      public function columsfromph($table_name, $limit, $offset, $column_name) {
        $this->db->limit($limit, $offset);
        $this->db->select($column_name);
        $this->db->order_by("id", "DESC");
        //$this->db->where_not_in($type, "");
        $this->db->where('dLocation =', '2')->or_where('dLocation =', '8')
                ->or_where('dLocation =', '3')->or_where('dLocation =', '6');
        //$this->db->where('sessionID =', $sessionID);
        $query = $this->db->get($table_name);
        //var_dump($query);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    
    
    
     //Get the Category Type
    public function groupconcatxcode($id){
        $q = "SELECT GROUP_CONCAT(ex_Code) as dCode FROM `cash_newrequest_expensedetails` 
            WHERE requestID IN ($id) GROUP BY requestID ";
        //SELECT requestID, GROUP_CONCAT(ex_Code) as dCode, SUM(ex_Amount) as total FROM `cash_newrequest_expensedetails` WHERE requestID IN (SELECT id FROM cash_newrequestdb) GROUP BY requestID
                    
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->dCode;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function budgetSum(){
        $q = "SELECT id, year_budget_id, year, unit, GROUP_CONCAT(month) as month, amount, monthly_budget_lock, dateCreated, currency, sum(amount) as total FROM `monthly_budget` GROUP BY unit, year";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
    
     public function monthlyBudgetExpenseNaira($unit, $year, $month){
        $q = "SELECT GROUP_CONCAT(id) as id, SUM(dAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') AND 
              YEAR(dateCreated) = '$year' AND MONTH(dateCreated) = '$month' AND CurrencyType IN('naira', 'NGN', '')";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function monthlyBudgetExpenseNairaonlySum($unit, $year, $month){
        $q = "SELECT SUM(dAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') AND 
              YEAR(dateCreated) = '$year' AND MONTH(dateCreated) = '$month' AND CurrencyType IN('naira', 'NGN', '')";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    
    
     public function monthlyBudgetExpenseOthers($unit, $year, $month){
        $q = "SELECT GROUP_CONCAT(id) as id, SUM(convertedAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') "
                . "AND YEAR(dateCreated) = '$year' AND MONTH(dateCreated) = '$month' AND CurrencyType NOT IN('naira', 'NGN', '') AND convertedAmount !='0.00'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
     public function monthlyBudgetExpenseOthersonlySum($unit, $year, $month){
        $q = "SELECT SUM(convertedAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') "
                . "AND YEAR(dateCreated) = '$year' AND MONTH(dateCreated) = '$month' AND CurrencyType NOT IN('naira', 'NGN', '') AND convertedAmount !='0.00'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
   
    
    
    
    
    
    
    
    //////////////////////////////////////BEGINNING OF YEARLY EXPENSE /////////////////////////////////////////////////////////
    
      public function yearlyExpenseNaira($unit, $year){
        $q = "SELECT SUM(dAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') AND 
              YEAR(dateCreated) = '$year'  AND CurrencyType IN('naira', 'NGN', '')";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
      public function yearlyExpenseOtherCurrency($unit, $year){
        $q = "SELECT SUM(convertedAmount) as totalCost FROM `cash_newrequestdb` WHERE dUnit = '$unit' AND approvals IN ('4','8') "
                . "AND YEAR(dateCreated) = '$year' AND CurrencyType NOT IN('naira', 'NGN', '') AND convertedAmount !='0.00'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
     ////////////////////////////////////// END OF YEARLY EXPENSE /////////////////////////////////////////////////////////
    
    
    
     public function jsonbudgetexpense(){
        //$q = "SELECT unit FROM `monthly_budget` GROUP BY unit";
        $q = "SELECT unit FROM `unitaccountcode_budget_setup` GROUP BY unit";
        
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
     public function jsonbudgetamount($year, $month){
        //$q = "SELECT unit, sum(amount) as total FROM `monthly_budget` WHERE year = '$year' AND month = '$month'  GROUP BY unit";
        $q = "SELECT unit, sum(amount) as total FROM `unitaccountcode_budget_setup` WHERE year = '$year' AND month = '$month'  GROUP BY unit";         
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
        
    public function rejectquotation($status, $sessionEmail, $reason, $batchid) {
        $q = "UPDATE quotereport SET status='$status',edmd='$sessionEmail', edm_date=NOW(), audit = case when audit is null then 'approval by $sessionEmail'
                  else concat(audit, '---approval by $sessionEmail -on ', Now()) end, reason = case when reason is null then '$reason -by $sessionEmail'
                  else concat(reason, '---$reason -by $sessionEmail -on ', Now()) end WHERE batchid='$batchid'";

        $this->db4->query($q);
        return TRUE;
    }
    
     public function approvequotation($status, $sessionEmail, $reason, $batchid) {
         
       $q = "UPDATE quotereport SET status='$status', edmd='$sessionEmail', edm_date=NOW(), audit = case when audit is null then 'approval by $sessionEmail'
                  else concat(audit, '---approval by $sessionEmail -on ', Now()) end, reason = case when reason is null then '$reason -by $sessionEmail'
                  else concat(reason, '---$reason -by $sessionEmail -on ', Now()) end WHERE batchid='$batchid'";

        $this->db4->query($q);
        return TRUE;
    }
   
    
    
    
    
      public function budgetitemsumforyear($unit, $year){
        $q = "SELECT SUM(amount) as totalCost FROM `unitaccountcode_budget_setup` WHERE unit = '$unit' AND year = '$year'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
      public function budgetSumItem(){
       // $q = "SELECT id, unit, year, month, SUM(amount) as totalCost FROM `unitaccountcode_budget_setup` GROUP BY unit, year";
        $q = "SELECT unitaccountcode_id, year, unit, GROUP_CONCAT(month) as month, sum(amount) as total FROM `unitaccountcode_budget_setup` GROUP BY unit, year";
       
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
     public function getbudgetmonth($year, $unit){
        $q = "SELECT unitaccountcode_id, year, unit, month, sum(amount) as total FROM `unitaccountcode_budget_setup` WHERE year='$year' AND unit='$unit' GROUP BY unit, month, year";
       
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    
    public function monthlybudgetexpense($exCode, $unit, $month, $year){
         $q = "SELECT amount FROM `unitaccountcode_budget_setup` WHERE codeNumber = '$exCode' AND unit = '$unit' AND month = '$month' AND year = '$year'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->amount;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
     public function monthlyexpenseperunit($exCode, $unit, $month, $year){
        $q = "SELECT SUM(ex_Amount) as totalCost FROM `cash_newrequest_expensedetails` WHERE dUnit = '$unit' AND ex_Code = '$exCode' AND YEAR(ex_Date) = '$year' AND MONTH(ex_Date) = '$month' AND sess != '' ";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function getsumamount($id){
        $q = "SELECT SUM(ex_Amount) as totalCost FROM `cash_newrequest_expensedetails` WHERE requestID = '$id' ";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    public function foryearunitmonth($year, $unit, $month){
        $q = "SELECT unitaccountcode_id, year, unit, month, amount, codeNumber, codeName FROM `unitaccountcode_budget_setup` WHERE unit='$unit' AND year='$year' AND month = '$month'";
       
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
     public function sumepartpay($id){
        $q = "SELECT SUM(partAmount) as totalCost FROM `partpayment` WHERE newcash_ID = '$id' ";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
     public function groupbyear($year){
        $q = "SELECT unit, year, SUM(amount) as total FROM `unitaccountcode_budget_setup` WHERE year = '$year' group by year, unit";
       
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            return $run_q->result();
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function totalbudgetforunit($exCode, $unit, $year){
        $q = "SELECT SUM(amount) as totalCost FROM `unitaccountcode_budget_setup` WHERE unit = '$unit' AND codeNumber = '$exCode' AND year = '$year'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function monthlytotalbudgetforunit($exCode, $unit, $month, $year){
        $q = "SELECT SUM(amount) as totalCost FROM `unitaccountcode_budget_setup` WHERE unit = '$unit' AND codeNumber = '$exCode' AND month = '$month' AND year = '$year'";
                 
        $run_q = $this->db->query($q);
        
         if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
    
    public function alltimeyearBudget($unit, $year){
         $q = "SELECT SUM(amount) as totalCost FROM `unitaccountcode_budget_setup` WHERE unit = '$unit' AND year = '$year'";
             
        $run_q = $this->db->query($q);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->totalCost;
            }
        }
        
        else{
            return FALSE;
        }
    }
    
   
    
    
    
    
    /////////////////////////////////////////// A PRINCESS //////////////////////////////////////////////////////////
     public function approvequotationhod($status, $sessionEmail, $reason, $batchid) {
         
       $q = "UPDATE quotereport SET status='$status', date=Now(), audit = case when audit is null then 'approval by $sessionEmail'
                  else concat(audit, '---approval by $sessionEmail -on ', Now()) end, reason = case when reason is null then '$reason -by $sessionEmail'
                  else concat(reason, '---$reason -by $sessionEmail -on ', Now()) end WHERE batchid='$batchid'";

        $this->db4->query($q);
        return TRUE;
    }
   
    
      public function approvequotationsupplychain($status, $sessionEmail, $reason, $batchid) {
         
       $q = "UPDATE quotereport SET status='$status', ghscm_date=NOW(), audit = case when audit is null then 'approval by $sessionEmail'
                  else concat(audit, '---approval by $sessionEmail -on ', Now()) end, reason = case when reason is null then '$reason -by $sessionEmail'
                  else concat(reason, '---$reason -by $sessionEmail -on ', Now()) end WHERE batchid='$batchid'";

        $this->db4->query($q);
        return TRUE;
    }
   
    
    
}

// End of Class Prediction extends CI_Model