<?php 
class paging{
	var $loader;
	var $showPagesatTime;
	var $recordsPerPage;
	
    function paging($par='')
    {
	
		$this->loader =& get_instance();
		$this->loader->load->model('wishlist_model');	
		$this->showPagesatTime = $this->loader->config->item('showPagesatTime');
		
		if(!$par)
		$this->recordsPerPage = $this->loader->config->item('recordsPerPage');
		
		else 
		$this->recordsPerPage = $par['par'];
		
	}
	
	function getTotalRecords($tbl,$conditionArr = array()){
		$counttbl = $this->loader->wishlist_model->retrieve_tblRecords($tbl,$conditionArr);
		return $counttbl;
	}	
	
	
	function getTotalSearchRecords($tbl,$field,$value){
		$counttbl = $this->loader->wishlist_model->retrieve_tblsearchRecords($tbl,$field,$value);
		return $counttbl;
	}	
	
	function getpageInfo($pg,$totalRecords){
	
	if($totalRecords == 0)
	$pagintation["start"] = 0;
	else
	$pagintation["start"] = (($pg - 1)* $this->recordsPerPage) + 1;
	
	if($totalRecords > ($pg * $this->recordsPerPage))
	$pagintation["end"] = $pg * $this->recordsPerPage;
	else
	$pagintation["end"] = $totalRecords;
	
	$pagintation["currentPage"] = $pg;
	$pagintation["totalrecordsperpage"] = $this->recordsPerPage;
	return $pagintation;
	}	

	function getAllPages($tbl,$recordLimits,$currentpg,$conditionArr = array()){
		$counttbl = $this->getTotalRecords($tbl,$conditionArr);
		
		if($recordLimits >  $counttbl)
		{
			$this->showPagesatTime = 1;
			return 1;
		}
		else 
		{
				if((ceil($counttbl / $recordLimits)) > $this->showPagesatTime)
				{
					 
					if($currentpg == 1)
					return "1+";
					
					else if(($currentpg + ($this->showPagesatTime-1)) < (ceil($counttbl / $recordLimits)))
					return "-".$currentpg ."_".($currentpg + ($this->showPagesatTime-1))."+";
					
					else if(($currentpg + ($this->showPagesatTime-1)) == (ceil($counttbl / $recordLimits)))
					return "-".$currentpg ."_".($currentpg + ($this->showPagesatTime-1));
					
					else if(($currentpg + ($this->showPagesatTime-1)) > (ceil($counttbl / $recordLimits)))
					{
						$getdiff =  ($currentpg + ($this->showPagesatTime-1)) - ceil($counttbl / $recordLimits) ;
						if(($currentpg - $getdiff) > 0)
						return "-".($currentpg - $getdiff) ."_".ceil($counttbl / $recordLimits);
						else
						return "-".$currentpg ."_".ceil($counttbl / $recordLimits);
					}
					
					else if($currentpg == (ceil($counttbl / $recordLimits)))
					return "-".(ceil($counttbl / $recordLimits));
				}
				
				else 
				{
					$this->showPagesatTime = ceil($counttbl / $recordLimits);
					return 1;
				}	
			
		}
	}		
		

	function getSearchPages($tbl,$recordLimits,$field,$search,$currentpg){
		$counttbl = $this->getTotalSearchRecords($tbl,$field,$search);
		
		if($recordLimits >  $counttbl)
		{
			$this->showPagesatTime = 1;
			return 1;
		}
		else 
		{
				if((ceil($counttbl / $recordLimits)) > $this->showPagesatTime)
				{
					 
					if($currentpg == 1)
					return "1+";
					
					else if(($currentpg + ($this->showPagesatTime-1)) < (ceil($counttbl / $recordLimits)))
					return "-".$currentpg ."_".($currentpg + ($this->showPagesatTime-1))."+";
					
					else if(($currentpg + ($this->showPagesatTime-1)) == (ceil($counttbl / $recordLimits)))
					return "-".$currentpg ."_".($currentpg + ($this->showPagesatTime-1));
					
					else if(($currentpg + ($this->showPagesatTime-1)) > (ceil($counttbl / $recordLimits)))
					{
						$getdiff =  ($currentpg + ($this->showPagesatTime-1)) - ceil($counttbl / $recordLimits) ;
						if(($currentpg - $getdiff) > 0)
						return "-".($currentpg - $getdiff) ."_".ceil($counttbl / $recordLimits);
						else
						return "-".$currentpg ."_".ceil($counttbl / $recordLimits);
					}
					
					else if($currentpg == (ceil($counttbl / $recordLimits)))
					return "-".(ceil($counttbl / $recordLimits));
				}
				
				else 
				{
					$this->showPagesatTime = ceil($counttbl / $recordLimits);
					return 1;
				}	
			
		}
	}	



function encodePage($pg){


		$paginateArr = "";
		$is_previous = false;
		$is_next = false;
		$is_range = false;
		
		$find = stripos($pg, '-');
		if($find !== false)
		{
			$is_previous = true;
			$pg = str_replace("-","",$pg);
		}
		
		$find = stripos($pg, '+');
		if($find !== false)
		{
			$is_next = true;
			$pg = str_replace("+","",$pg);
		}
		
		$find = stripos($pg, '_');
		
		if($find !== false)
		{
			$pgArr = explode("_",$pg);
			$startPg = $pgArr[0];
			$endPg = $pgArr[1];
			$is_range = true;
		}
		
		
		if($is_range == false)
		{	
				$counter = 0;
				if($is_previous)
				{
					$paginateArr[$counter]["symbol"] = "<";
					$paginateArr[$counter]["href"] = $pg - 1;
					$counter++;
					
					for($i = ($pg - $this->showPagesatTime); $i< $pg; $i++)
					{
						$paginateArr[$counter]["symbol"] = $i;
						$paginateArr[$counter]["href"] = $i;	
						$counter++;
					}
					
				}
				else if($is_next)
				{
		
					for($i = $pg; $i< ($pg + $this->showPagesatTime); $i++)
					{
						$paginateArr[$counter]["symbol"] = $i;
						$paginateArr[$counter]["href"] = $i;	
						$counter++;
					}
					
						$paginateArr[$counter]["symbol"] = ">";
						$paginateArr[$counter]["href"] = $pg + 1;
					
				} 
				else 
				{
					for($i = $pg; $i< ($pg + $this->showPagesatTime); $i++)
					{
						$paginateArr[$counter]["symbol"] = $i;
						$paginateArr[$counter]["href"] = $i;	
						$counter++;
					}
				}
		}
		else
		{
				$counter = 0;
					if($is_previous)
					{
						$paginateArr[$counter]["symbol"] = "<";
						$paginateArr[$counter]["href"] = $startPg - 1;
						$counter ++ ;
					}	
				
					for($i = $startPg; $i<= $endPg; $i++)
					{
						$paginateArr[$counter]["symbol"] = $i;
						$paginateArr[$counter]["href"] = $i;	
						$counter++;
					}
					
					if($is_next)
					{
						$paginateArr[$counter]["symbol"] = ">";
						$paginateArr[$counter]["href"] = $endPg + 1;
						$counter ++ ;
					}	
						
		}
		
		return $paginateArr;
		
	}	
	
	function getAllFrontData($pg = 1,$sort = '',$recordLimit='',$catid=''){
	if($sort == '')
	$sort = 'items_id';
	
	$limitStart = ($pg - 1)*  $recordLimit;
	$totallimit =  $recordLimit;

	
	$userArr = $this->loader->wishlist_model->retrieve_allFrontData($limitStart,$totallimit,$sort,$catid);
	return $userArr;
	}
		
}

?>