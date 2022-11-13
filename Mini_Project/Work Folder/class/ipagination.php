<?php
class ipagination
{
	var $query;
	var $perpage;
	var $show;
	var $pstart;
	var $pinfo;
	var $trows;
	var $ppage;
	var $showpage;
	var $showmax;
	var $npage;
	var $pageno;
	var $con;
	
	function pageinfo()
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
				$trows= $prow;
				$this->pinfo=$pinfo;
				$this->trows=$trows;
				
				//echo $trows;
				//echo $pinfo;
				
				$this->pstart = $pstart;
				
		$this->ppage = $ppage;
		$this->showpage = $showpage;
		$this->showmax = $showmax;
		$this->npage = $npage;
		$this->pageno = $pageno;
				
	}
		function pagenav()
	{
		$ppage=$this->ppage;
		$showpage=$this->showpage;
		$showmax=$this->showmax;
		$npage=$this->npage;
		$pageno=$this->pageno;
	
		?>
          <ul class="pagination pagination-sm no-margin pull-right">
          
          <?php 
		  if(isset($_GET["q"]))
		  {
			  $qs=$_GET["q"];
		  }
		  else
		  {
			  $qs='';
		  }
		   ?>
          <?php if($ppage>=2) { ?>
          <li><a href="<?php if($qs!=''){ echo "?q=".$qs."&amp;"; } else { echo "?"; } ?>page=<?php echo 1; ?>" title="First">&laquo;&laquo;</a></li>
          <?php
		  }
		  ?>
                     <?php if($ppage!='') { ?>
                      <li><a href="<?php if($qs!=''){ echo "?q=".$qs."&amp;"; } else { echo "?"; } ?>page=<?php echo $ppage; ?>" title="Previous">&laquo;</a></li>
                    <?php } ?>  
                      <?php
					  for($i=$showpage; $i<=$showmax; $i++)
					  {
					  ?>
                      <li><a href="<?php if($qs!=''){ echo "?q=".$qs."&amp;"; } else { echo "?"; } ?>page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                      <?php
					  }
					  ?>
                      <?php if($npage!='') { ?>                      
                      <li><a href="<?php if($qs!=''){ echo "?q=".$qs."&amp;"; } else { echo "?"; } ?>page=<?php echo $npage; ?>" title="Next">&raquo;</a></li>
                      <?php } ?>
			 <?php if($npage!='' && $npage<=($pageno-1))  { ?>
            <li><a href="<?php if($qs!=''){ echo "?q=".$qs."&amp;"; } else { echo "?"; } ?>page=<?php echo $pageno; ?>" title="Last">&raquo;&raquo;</a></li>
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
