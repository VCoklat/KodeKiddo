<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
<div class="content-wrapper">
		
	<?php
	// little script to pull the current date/time; can also be done via JavaScript or 100 other ways

	//include("assets/includes/now.fn");

		if(!empty($user))
        {
            foreach ($user as $rl)
            {
                $_SESSION['fullname']		= $rl->name;
            }
        }
		if(!empty($milestone))
        {
            foreach ($milestone as $rl)
            {
				$_SESSION['milestone']		= $rl->milestoneId;
            }
        }
        
		//$_SESSION['fullname']		= isset($_POST['fullname']) ? $_POST['fullname'] : '';
		//$_SESSION['title']		= isset($_POST['title']) ? $_POST['title'] : '';
		//$_SESSION['company']		= isset($_POST['company']) ? $_POST['company'] : '';
		$_SESSION['time']		= isset($_POST['time']) ? $_POST['time'] : '';
	?>
	<div id="testdiv">
	
	<table width="100%" height="500" style="background-image:url(<?php echo base_url(); ?>assets/images/certificate_border.png); background-position: center center; background-repeat: no-repeat; background-size: 100% 100%;" >
		<td align="center">
			<h2>
				<?php echo  $_SESSION['fullname']; ?>				
			</h2>

			<h4>

				<br>
				<strong>
				
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo  $_SESSION['milestone'] ?>
				</strong>
			</h4>
			
		</td>
	</table>

	</div>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
	
		$(document).ready(function() {
		//var testdiv = document.getElementById("testdiv");
			html2canvas($("#testdiv"), {
				onrendered: function(canvas) {
					// canvas is the final rendered <canvas> element
					
					var myImage = canvas.toDataURL("image/png");
					var doc = new jsPDF("l");
					var width = doc.internal.pageSize.width;    
					var height = doc.internal.pageSize.height;
					doc.addImage(myImage, 'JPEG', 0, 0, width, height);
					doc.save($.now()+'.pdf')
					
				}
			});
		});
    </script>