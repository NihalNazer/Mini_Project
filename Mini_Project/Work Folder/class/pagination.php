<?php
class pagination
{
	var $query;
	var $perpage;
	var $show;
	var $pstart;
	var $pinfo;
	var $trows;
	var $con;
	
	function pagenav()
	{
				$pselect= $this -> query;
				$perpage= $this -> perpage;
				$show= $this -> show;
				$con= $this -> con;
				
  				$presult=mysqli_query($con, $pselect);
				$prow=mysqli_num_rows($presult);
								
				 $pageno=ceil($prow/$perpage);
				 
				 if($show>$pageno)
				 {
					 $show=$pageno;
				 }
				 
				if(isset($_GET["page"]))
				{
					 $cpage=$_GET["page"];
				}
				else
				{
					 $cpage=1;
				}
				
				if($cpage>=$pageno)
				{
					//$npage=1;
					 $npage='';
				}
				else
				{
					 $npage=$cpage+1;
				}
				
				if($cpage==1)
				{
				//$ppage=$pageno;
				 $ppage='';
				}
				else
				{
					 $ppage=$cpage-1;
					
				}
				  $pstart=($cpage-1)*$perpage;
				  $showmax=$cpage+($show-1);
				if($showmax>$pageno)
				{
					  $showmax=$pageno;
				}
				
				if(($cpage+$show)>=$pageno)
				{
					  $showpage=$showmax-($show-1);
					if($showpage==0)
					{
						  $showpage=1;
					}
				}
				else
				{
				  $showpage=$cpage;
				}
				
				$pinfo= " (".$cpage ." of ". $pageno." Pages)";
				$trows= $prow." Results ";
				$this->pinfo=$pinfo;
				$this->trows=$trows;
				
				//echo $trows;
				//echo $pinfo;
				
				$this->pstart = $pstart;
				
				
		
	
		?>
          <ul class="pagination pagination-sm inline">
                     <?php if($ppage!='') { ?>
                      <li><a href="?page=<?php echo $ppage; ?>">&laquo;</a></li>
                    <?php } ?>  
                      <?php
					  for($i=$showpage; $i<=$showmax; $i++)
					  {
					  ?>
                      <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php
					  }
					  ?>
                      <?php if($npage!='') { ?>                      
                      <li><a href="?page=<?php echo $npage; ?>">&raquo;</a></li>
                      <?php } ?>
			
                    </ul>
        <?php
	}
	function getDetails()
	{
		$trows=$this->trows;
		return $trows;
	}
}
?>
